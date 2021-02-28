<template>
  <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg bg-gray-500 mb-3">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
      <div class="w-full relative flex justify-between lg:w-auto  px-4 lg:static lg:block lg:justify-start">
        <router-link :to="{ name: user ? 'home' : 'welcome' }" class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-no-wrap uppercase text-white">
          {{ appName }}
        </router-link>
        <button class="text-white cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button" @click="toggleNavbar()">
          <i class="fas fa-bars" />
        </button>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  components: {
  },

  data: () => ({
    appName: window.config.appName,
    showMenu: false
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    toggleNavbar: function () {
      this.showMenu = !this.showMenu
    }
  }
}
</script>

<style scoped>
</style>
