<template>
  <div>
    <h2>{{ $t('your_info') }}</h2>
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('info_updated')" />

      <!-- Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
        <div class="col-md-7">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
          <has-error :form="form" field="name" />
        </div>
      </div>

      <!-- Email -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
        <div class="col-md-7">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
          <has-error :form="form" field="email" />
        </div>
      </div>

      <!-- Address Line 1 -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('address_line_1') }}</label>
        <div class="col-md-7">
          <input v-model="form.address_line_1" :class="{ 'is-invalid': form.errors.has('address_line_1') }" class="form-control" type="text" name="address_line_1">
          <has-error :form="form" field="address_line_1" />
        </div>
      </div>

      <!-- Address Country -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('address_country') }}</label>
        <div class="col-md-7">
          <select v-model="form.address_country" :class="{ 'is-invalid': form.errors.has('address_country') }" class="form-control">
            <option disabled value="">
              Please select one
            </option>
            <option v-for="(key, value) in countries" :key="key">
              {{ value }}
            </option>
          </select>
          <has-error :form="form" field="address_country" />
        </div>
      </div>

      <!-- Address City -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('address_city') }}</label>
        <div class="col-md-7">
          <input v-model="form.address_city" :class="{ 'is-invalid': form.errors.has('address_city') }" class="form-control" type="text" name="address_city">
          <has-error :form="form" field="address_city" />
        </div>
      </div>

      <!-- Address Postcode -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('address_postcode') }}</label>
        <div class="col-md-7">
          <input v-model="form.address_postcode" :class="{ 'is-invalid': form.errors.has('address_postcode') }" class="form-control" type="text" name="address_postcode">
          <has-error :form="form" field="address_postcode" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <button :loading="form.busy" type="success">
            {{ $t('update') }}
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import countries from '../../assets/countries.json'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      address_line_1: '',
      address_country: '',
      address_city: '',
      address_postcode: ''
    }),
    countries
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

  methods: {
    async update () {
      const { data } = await this.form.patch('/api/settings/profile')

      this.$store.dispatch('auth/updateUser', { user: data })
    }
  }
}
</script>
