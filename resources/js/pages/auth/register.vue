<template>
  <div>
    <RegisterChoice v-if="!registrationType" @click="handleRegistrationType" />
    <RegisterWithEmail v-if="registrationType === 'email'" />
  </div>
</template>

<script>
import RegisterChoice from '~/components/sections/registerChoice'
import RegisterWithEmail from '~/components/sections/registerWithEmail'

export default {
  middleware: 'guest',
  layout: 'split',
  components: {
    RegisterChoice,
    RegisterWithEmail
  },

  metaInfo () {
    return { title: this.$t('register') }
  },

  data: () => ({
    registrationType: null
  }),

  methods: {
    handleRegistrationType (type) {
      this.registrationType = type
    }
  }
}
</script>
