import { Home } from '../components'

export default [
	{
		path: '/',
		name: 'home',
		component: Home,
		meta: {
			guest: true,
			needsAuth: false
		}	
	}
]