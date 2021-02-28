<template>
  <main class="welcomeSearch relative flex flex-wrap items-center justify-between">
    <div class="container px-4 mx-auto my-12 flex flex-wrap items-center justify-between">
      <div class="w-full relative flex justify-between lg:w-auto  px-4 lg:static lg:block lg:justify-start">
        <h2>{{ $t('welcomeSearch-title') }}</h2>
        <h2>{{ $t('welcomeSearch-paragraph') }}</h2>
        <form @submit.prevent="handleForm" @keydown="form.onKeydown($event)">
          <div class="">
            <label class="">{{ $t('search') }}</label>
            <div class="">
              <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" class="appearance-none relative block w-auto px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none rounded-md focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" type="text" name="address">
              <has-error :form="form" field="address" />
              <div class="welcomeSearch__currentLocation" @click="currentLocation">
                {{ $t('use_current_location') }}
              </div>
            </div>
            <button class="">
              {{ $t('search') }}
            </button>
          </div>
        </form>
      </div>
    </div>
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
