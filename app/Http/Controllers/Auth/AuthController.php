<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\{RegisterFormRequest, LoginFormRequest};
use App\Http\Resources\PrivateUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
	public $auth;

    public function __construct(JWTAuth $auth)
    {
    	$this->auth = $auth;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginFormRequest $request)
    {
    	try {
    		if (!$token = $this->auth->attempt($request->only('email', 'password'))) {
    			return response()->json([
                    'errors' => [
                        'root' => 'Could not sign you in with those details.'
                    ]
    			], 401);
    		}
    	} catch (JWTException $e) {
    		return response()->json([
                'errors' => [
                    'root' => 'Could not sign you in with those details.'
                ]
            ], $e->getStatusCode());
    	}

       return (new PrivateUserResource($request->user()))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }

    public function register(RegisterFormRequest $request)
    {
    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    	]);

    	$token = $this->auth->attempt($request->only('email', 'password'));

    	return (new PrivateUserResource($user))->additional([
			'meta' => [
				'token' => $token
			]
		]);
    	
    }

    public function logout()
    {
        $this->auth->invalidate($this->auth->getToken());

        return response()->json(null, 200);
    }

    public function me()
    {
        return (new PrivateUserResource(auth()->user()))->additional([
            'meta' => [
                
            ]
        ]);
    }
}
