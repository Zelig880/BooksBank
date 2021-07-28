<template>
  <div class="login">
    <div>
      <h2 class="mt-8 text-2xl font-bold">
        {{ $t('signin-title') }}
      </h2>
      <p class="mt-4 mb-8">
        {{ $t('signin-description') }}
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
    <form @submit.prevent="login" @keydown="form.onKeydown($event)">
      <div class="w-full border-2 py-4 px-4 mb-8 flex rounded-lg">
        <fa icon="envelope" fixed-width />
        <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="w-full ml-4" type="text" name="email" :placeholder="$t('email')">
      </div>
      <div class="w-full border-2 py-4 px-4 mb-8 flex rounded-lg">
        <fa icon="lock" fixed-width />
        <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="w-full ml-4" type="password" name="password" :placeholder="$t('password')">
      </div>
      <a href="#">{{ $t('forgot_password') }}</a>
      <has-error :form="form" field="email" />
      <has-error :form="form" field="password" />
      <button type="text" class="submit-button" :loading="form.busy">
        {{ $t('login') }}
      </button>
    </form>
  </div>
</template>

<script>
import Form from 'vform'
import LoginWithOAuth from '~/components/sections/LoginWithOAuth'

export default {
  middleware: 'guest',
  layout: 'split',

  components: {
    LoginWithOAuth
  },

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')
      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect to the page that required the auth if exists
      if (this.$route.query.redirect) {
        this.$router.push(this.$route.query.redirect)
      } else {
        this.$router.push({ name: 'welcome' })
      }
    }
  }
}
</script>

<style lang="scss">
.login{
  .submit-button{
    @apply w-full border-2 py-4 px-4 mt-8 rounded-lg text-white;
    text-transform: uppercase;
    background-color: var(--outline);
  }
}
</style>
