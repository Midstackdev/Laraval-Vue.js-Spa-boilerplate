<template>
	<div class="container">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half">
				<div class="card">
					<div class="card-content">
						<p class="title">Login to begin</p>
						<hr>
						<form @submit.prevent="submit">
							<div class="notification is-danger" v-if="errors.root">
							  <button class="delete"></button>
							  {{ errors.root }}
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
							      Login
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
	import localforage from 'localforage'
	import { isEmpty } from 'lodash'

	export default {
		data () {
			return {
				email: null,
				password: null,
				errors: []
			}
		},

		methods: {
			...mapActions({
				'login': 'auth/login'
			}),

			submit () {
				this.login({
					payload: {
						email: this.email,
						password: this.password,
					},
					context: this
				}).then(() => {
					localforage.getItem('intended').then((name) => {

						if (isEmpty(name)) {
							this.$router.replace({name : 'home'})
							return
						}

						this.$router.replace({name : name})
					})
				})
			}
		}
	}
</script>