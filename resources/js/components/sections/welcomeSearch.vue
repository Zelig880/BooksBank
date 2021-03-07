<template>
  <main class="bg-gray-200 py-10">
    <div class="container mx-auto h-auto">
      <div class="mb-6 md:w-3/6">
        <h2 class="text-5xl font-bold mb-4">
          {{ $t('welcomeSearch-title') }}
        </h2>
        <p>{{ $t('welcomeSearch-paragraph') }}</p>
      </div>
      <form class="md:bg-white md:w-4/5 md:rounded-full md:pl-10 md:flex h-auto md:h-16 " @submit.prevent="handleForm" @keydown="form.onKeydown($event)">
        <div class="bg-white md:bg-none rounded-full md:rounded-none flex flex-col md:flex-grow py-2 px-10 md:px-0 md:mr-4 w-10/12 md:w-auto mx-auto">
          <label>Search by</label>
          <input :class="{ 'is-invalid': form.errors.has('address') }" type="text" placeholder="ISBN or Name">
        </div>
        <div class="bg-white md:bg-none rounded-full md:rounded-none flex flex-col md:flex-grow md:pl-4 py-2 px-10 md:px-0 mr-x mt-6 md:mt-0 border-l-2 w-10/12 md:w-auto mx-auto">
          <label>Location</label>
          <input v-model="form.address" type="text" placeholder="Postcode">
        </div>
        <button class="bg-gray-500 block text-white font-bold rounded-full md:rounded-l-none flex-grow mt-6 md:mt-0 w-10/12 md:w-1/4 mx-auto py-4">
          {{ $t('search') }}
        </button>
      </form>
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
