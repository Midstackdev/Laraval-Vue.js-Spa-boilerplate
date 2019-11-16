<template>
	<div>
		<nav class="navbar" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <router-link :to="{ name: 'home' }" class="navbar-item">
          <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        </router-link>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>

      <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
          <router-link :to="{ name: 'home' }" class="navbar-item">
            Home
          </router-link>

          <router-link :to="{ name: 'timeline' }" class="navbar-item">
            About
          </router-link>

        </div>

        <div class="navbar-end">
          <template v-if="user.authenticated">
            <router-link :to="{ name: 'home' }" class="navbar-item">
              Home
            </router-link>

            <router-link :to="{ name: 'timeline' }" class="navbar-item">
              Timeline
            </router-link>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link">
                {{user.data.name}}
              </a>

              <div class="navbar-dropdown">
                <a class="navbar-item" @click.prevent="signout">
                  Logout
                </a>
              </div>
            </div>
          </template>
          <div class="navbar-item" v-if="!user.authenticated">
            <div class="buttons">
              <router-link :to="{ name: 'register' }" class="button is-primary">
                <strong>Sign up</strong>
              </router-link>
              <router-link  :to="{ name: 'login' }" class="button is-light">
                Log in
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
	import { mapGetters, mapActions } from 'vuex'

	export default {
		computed: {
			...mapGetters({
				user: 'auth/user'
			})
		},

    methods: {
      ...mapActions({
        logout: 'auth/logout'
      }),

      signout () {
        this.logout().then(() => {
          this.$router.replace({name: 'home'})
        })
      }
    }
	}
</script>