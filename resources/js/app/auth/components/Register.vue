<template>
	<div class="container">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half">
				<div class="card">
					<div class="card-content">
						<p class="title">Sign in to register</p>
						<hr>
						<form @submit.prevent="submit">
							<div class="field">
							  <label class="label">Name</label>
							  <div class="control">
							    <input class="input" type="text" placeholder="e.g Alex Smith" v-model="name" :class="{'is-danger' : errors.name}">
							  </div>
							  <p class="help is-danger" v-if="errors.name">{{ errors.name[0] }}</p>
							</div>

							<div class="field">
							  <label class="label">Email</label>
							  <div class="control">
							    <input class="input" type="email" placeholder="e.g. alexsmith@gmail.com" v-model="email" :class="{'is-danger' : errors.email}">
							  </div>
							  <p class="help is-danger" v-if="errors.email">{{ errors.email[0] }}</p>
							</div>
							<div class="field">
							  <label class="label">Password</label>
							  <div class="control">
							    <input class="input" type="password" v-model="password" :class="{'is-danger' : errors.password}">
							  </div>
							  <p class="help is-danger" v-if="errors.password">{{ errors.password[0] }}</p>
							</div>
							<div class="field">
							  <p class="control">
							    <button class="button is-success">
							      Sign up
							    </button>
							  </p>
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</template>

<script>
	import { mapActions } from 'vuex'

	export default {
		data () {
			return {
				name: null,
				password: null,
				email: null,
				errors: []
			}
		},

		methods: {
			...mapActions({
				'register' : 'auth/register'
			}),
			submit() {
				this.register({
					payload: {
						name: this.name,
						email: this.email,
						password: this.password,
					},
					context: this
				}).then(() => {
					this.$router.replace({name : 'home'})
				})
			}
		}
	}
</script>