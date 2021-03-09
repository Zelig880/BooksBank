<template>
  <div class="split-layout bg-gray-300">
    <div class="relative flex flex-wrap items-center justify-between py-3 mb-3 bg-white">
      <div class="container mx-auto flex flex-wrap items-center justify-between">
        <h1 class="w-auto static block justify-start">
          <img src="/assets/img/Logo-2-colour.svg" :alt="appName">
        </h1>
      </div>
      <div class="w-full flex justify-center">
        <div class="lg:w-1/2 lg:text-right">
          <div class="split-layout__left-column pr-0 lg:pr-16 ml-8 mt-16 xl:ml-auto text-center lg:text-left">
            <div class="border-b pb-4">
              <router-link :to="{name: 'login'}" class="mr-16 pb-4 capitalize" :class="{ 'border-b-4': signinPage}">
                Signin
              </router-link>
              <router-link :to="{name: 'register'}" class="mr-16 pb-4 capitalize" :class="{ 'border-b-4': signupPage}">
                Signup
              </router-link>
            </div>
            <child />
          </div>
        </div>
        <div class="hidden lg:block w-1/2">
          <img :src="imagePath" alt="Authentication image">
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'SplitLayout',

  components: {
  },
  data () {
    return {
      appName: window.config.appName
    }
  },
  computed: {
    signinPage () {
      return this.$route.name === 'login'
    },
    signupPage () {
      return this.$route.name === 'register'
    },
    imagePath () {
      return `/assets/img/splitLayout-${this.$route.name}.png`
    }
  }
}
</script>

<style lang="scss">
.split-layout{
  &__left-column{
    max-width: 640px;
  }
}
</style>
