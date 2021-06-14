<template>
  <div class="registerWithEmail">
    <div v-if="mustVerifyEmail">
      <div class="alert alert-success" role="alert">
        {{ $t('verify_email_address') }}
      </div>
    </div>
    <div v-else>
      <h2 class="mt-8 mb-8 text-2xl font-bold">
        {{ $t('register_with_email') }}
      </h2>
      <form @submit.prevent="register" @keydown="form.onKeydown($event)">
        <label for="name">{{ $t('name') }}</label>
        <div class="w-full border-2 py-4 px-4 mb-8 flex rounded-lg">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="w-full ml-4" type="text" name="name" :placeholder="$t('register_name_placeholder')">
        </div>
        <label for="email">{{ $t('email') }}</label>
        <div class="w-full border-2 py-4 px-4 mb-8 flex rounded-lg">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="w-full ml-4" type="text" name="email" :placeholder="$t('register_email_placeholder')">
        </div>
        <label for="password">{{ $t('password') }}</label>
        <div class="w-full border-2 py-4 px-4 mb-8 flex rounded-lg">
          <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="w-full ml-4" type="password" name="password" :placeholder="$t('register_password_placeholder')">
        </div>
        <label for="password_confirmation">{{ $t('confirm_password') }}</label>
        <div class="w-full border-2 py-4 px-4 mb-8 flex rounded-lg">
          <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="w-full ml-4" type="password" name="password_confirmation" :placeholder="$t('register_password_placeholder')">
        </div>
        <Checkbox @click="policySigned = true" class="w-full">I agree to the <a target="_blank" href="/privacy">privacy policy</a></Checkbox>
        <has-error :form="form" field="name" />
        <has-error :form="form" field="email" />
        <has-error :form="form" field="password" />
        <has-error :form="form" field="password_confirmation" />
        <has-error :form="form" field="policy" />
        <button :disabled="!policySigned" :loading="form.busy">
          {{ $t('register_cta') }}
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {

  metaInfo () {
    return { title: this.$t('register_with_email') }
  },
  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false,
    policySigned: false
  }),
  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'welcome' })
      }
    }
  }
}
</script>

<style lang="scss">
.registerWithEmail{
  button{
    @apply w-full border-2 py-4 px-4 mt-8 rounded-lg text-white;
    text-transform: uppercase;
    background-color: var(--outline);
    &:disabled{
      cursor:no-drop;
    background-color: var(--body-standard);
    }
  }
}
</style>