<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <h2>{{ $t('verify_email') }}</h2>
      <form @submit.prevent="send" @keydown="form.onKeydown($event)">
        <alert-success :form="form" :message="status" />

        <!-- Email -->
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
          <div class="col-md-7">
            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
            <has-error :form="form" field="email" />
          </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group row">
          <div class="col-md-9 ml-md-auto">
            <button :loading="form.busy">
              {{ $t('send_verification_link') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('verify_email') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  created () {
    if (this.$route.query.email) {
      this.form.email = this.$route.query.email
    }
  },

  methods: {
    async send () {
      const { data } = await this.form.post('/api/email/resend')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
