<template>
  <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-gray-200 navbar-expand-lg mb-3">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
      <h1 class="w-full relative flex justify-between lg:w-auto  px-4 lg:static lg:block lg:justify-start">
        <router-link :to="{ name: user ? 'home' : 'welcome' }">
          <img src="/assets/img/Logo-2-colour.svg" alt="Stack Overflow">
        </router-link>
      </h1>
      <div id="example-navbar-info" class="flex lg:flex-grow items-center">
        <authControls :authenticated="!!user" @logout="onLogout" />
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

import authControls from './Navbar/authControls'

export default {
  components: {
    authControls
  },

  data: () => ({
    appName: window.config.appName,
    showMenu: false
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    ...mapActions('auth', ['logout']),
    toggleNavbar: function () {
      this.showMenu = !this.showMenu
    },
    async onLogout () {
      // Log out the user.
      await this.logout()

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
</style>
