<template>
  <main class="welcomeSearch py-10">
    <div class="container mx-auto md:pl-24 h-auto">
      <div class="inline-block mx-3 pb-4 md:pb-16 md:w-3/6 align-text-bottom">
        <h2 class="Light-backgroundH1---h6H1">
          {{ $t('welcomeSearch-title') }}
        </h2>
        <p>{{ $t('welcomeSearch-paragraph') }}</p>
      </div>
      <div class="hidden md:inline-block md:w-2/6">
        <img class="welcomeSearch_illustration" src="/assets/img/search-for-books.svg" alt="Illustration of lady reading a book">
      </div>
      <form class="md:bg-white md:w-4/5 md:rounded-full md:pl-10 md:flex h-auto md:h-18 mt-10" @submit.prevent="handleForm" @keydown="form.onKeydown($event)">
        <div class="bg-white md:bg-none rounded-full md:rounded-none flex flex-col md:flex-grow py-2 px-10 md:px-0 md:mr-4 w-10/12 md:w-auto mx-auto">
          <label>Books title or All</label>
          <input v-model="form.searchTitle" :class="{ 'is-invalid': form.errors.has('searchTitle') }" type="text" placeholder="The lord of the ring">
        </div>
        <div class="bg-white md:bg-none rounded-full md:rounded-none flex flex-col md:flex-grow md:pl-4 py-2 px-10 md:px-0 mr-x mt-6 md:mt-0 border-l-2 w-10/12 md:w-auto mx-auto">
          <label>Location</label>
          <input v-model="form.postcode" type="text" placeholder="city or postcode">
        </div>
        <button id="search-button" class="block text-white font-bold rounded-full md:rounded-l-none flex-grow mt-6 md:mt-0 w-10/12 md:w-1/4 mx-auto py-4">
          {{ $t('search') }}
        </button>
      </form>
    </div>
  </main>
</template>

<script>
import { mapActions } from 'vuex'
import Form from 'vform'
import Swal from 'sweetalert2'

export default {

  data: () => ({
    form: new Form({
      searchTitle: 'All',
      postcode: '',
      latitude: null,
      longitude: null,
      radius: 15
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
        const position = await this.getGeolocation(this.postcode)

        if (!position) {
          Swal.fire({
            type: 'error',
            title: 'Location not found!',
            text: 'The location could not be found. Please enter your city/town name, or your postcode without spaces (eg. sa49la).'
          })
          return
        }
        this.form.latitude = position.lat
        this.form.longitude = position.lon
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
#search-button{
  background-color: var(--outline);
}
.welcomeSearch{
  background-color: var(--light-3);
  h2{
    margin: 0 0 23px;
  }
  p{
    margin: 23px 0 0 6px;
    font-family: OpenSans;
    font-size: 28px;
    line-height: 1.5;
    letter-spacing: -0.57px;
    color: var(--sub-text);
  }
  &_illustration{
    width: 300px;
    margin: 0 auto;
  }
  form{
    label{
      font-family: OpenSans;
      font-size: 14px;
      font-weight: 600;
      color: var(--body-dark);
    }

    input[type=text] {
      font-size: 25px;
    }
  }

}

@media (max-width:768px) {
  .welcomeSearch{
    p {
      font-size: 20px;
    }
  }
}
</style>
