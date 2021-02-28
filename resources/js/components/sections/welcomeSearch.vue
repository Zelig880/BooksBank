<template>
  <main class="welcomeSearch">
    <form @submit.prevent="handleForm" @keydown="form.onKeydown($event)">
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('search') }}</label>
        <div class="col-md-5">
          <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" class="form-control" type="text" name="address">
          <has-error :form="form" field="address" />
          <div class="welcomeSearch__currentLocation form-text text-info" @click="currentLocation">
            {{ $t('use_current_location') }}
          </div>
        </div>
        <button class="col-md-2">
          {{ $t('search') }}
        </button>
      </div>
    </form>
  </main>
</template>

<script>
import { mapActions } from 'vuex'
import Form from 'vform'

export default {

  data: () => ({
    form: new Form({
      address: '',
      latitude: null,
      longitude: null,
      radius: 3000
    })
  }),

  methods: {
    ...mapActions('library', ['search']),
    async getGeolocation () {
      const { data } = await this.form.post('/api/geolocation/getGeolocationByUserQuery')

      return data[0]
    },
    async handleForm () {
      if (!this.form.latitude || !this.form.longitude) {
        const { lat, lon } = await this.getGeolocation(this.address)
        this.form.latitude = lat
        this.form.longitude = lon
      }
      
      this.$router.push({ name: 'library.view', params: this.form })
    },
    async currentLocation () {
      const position = await new Promise((resolve, reject) => {
        navigator.geolocation.getCurrentPosition(resolve, reject)
      })
      if (position.coords) {
        this.form.latitude = position.coords.latitude
        this.form.longitude = position.coords.longitude
      }
    }
  }
}
</script>

<style lang="scss">
.welcomeSearch{
  &__currentLocation{
    cursor: pointer;
  }
}
</style>
