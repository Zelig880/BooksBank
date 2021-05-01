<template>
  <div>
    <h2>{{ $t('your_info') }}</h2>
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('info_updated')" />

      <alert-success :form="form" :message="$t('info_updated')" />
      <template v-for="field in formFields">
        <div :key="field">
          <label>{{ $t(field) }}:</label>
          <div class="w-full border-b-2 py-4 px-4 mb-8 flex items-center">
            <fa :icon="iconByField(field)" fixed-width />
            <input v-model="form[field]" :class="{ 'is-invalid': form.errors.has(field) }" class="w-full ml-4" type="text" :name="field" :placeholder="$t(field)">
            <has-error :form="form" :field="field" />
          </div>
        </div>
      </template>

      <Button :loading="form.busy" class="absolute bottom-4 right-4" >
        {{ $t('update') }}
      </Button>
    </form>
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: ''
    }),
    formFields: ['name', 'email']
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },

  mounted () {
    this.form.name = this.user.name
    this.form.email = this.user.email
  },

  methods: {
    async update () {
      const { data } = await this.form.patch('/api/settings/profile')

      this.$store.dispatch('auth/updateUser', { user: data })
    }
  }
}
</script>
