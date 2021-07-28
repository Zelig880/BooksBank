<template>
  <div>
    <div>
      <h2 class="mt-8 mb-8 text-2xl font-bold">
        {{ $t('register_title') }}
      </h2>
      <p class="mt-4 mb-8">
        {{ $t('register_description') }}
      </p>
      <LoginWithOAuth provider="google">
        <img src="/assets/img/Google__G__Logo.png" class="inline mr-3" alt="google logo">{{ $t('continue-with-google') }}
      </LoginWithOAuth>
      <!-- <LoginWithOAuth provider="facebook">
        <img src="/assets/img/facebook-logo.png" class="inline mr-3" alt="facebook logo">{{ $t('continue-with-facebook') }}
      </LoginWithOAuth> -->
    </div>
    <div class="flex my-8">
      <span class="border-b-2 flex-grow mb-3" />
      <span class="mx-4 text-gray-400">OR</span>
      <span class="border-b-2 flex-grow mb-3" />
    </div>
    <button class="w-full rounded-2 py-3 border-2" @click="handleClick('email')">
      {{ $t('register_with_email') }}
    </button>
  </div>
</template>

<script>
import LoginWithOAuth from '~/components/sections/LoginWithOAuth'
export default {
  components: {
    LoginWithOAuth
  },
  methods: {
    handleClick (type) {
      this.$emit('click', type)
    }
  }
}
</script>

<style>

</style>
