<template>
  <div class="bookshelf_settings">
    <h2 class="">
      {{ $t('your_info') }}
    </h2>
    <div class="bookshelf_settings__container">
      <div>
        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
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

          <!-- Submit Button -->
          <div class="">
            <div class="col-md-9 ml-md-auto">
              <button :loading="form.busy" type="success">
                {{ $t('update') }}
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="relative">
        <div>
          <h3>My Library Opening type</h3>
          <sub>What times are you most likely to be home for books collection and dropoff?</sub>
          <LendTimeSlot type="times" :selected-slots.sync="form.days" />
        </div>
        <div>
          <h3>My Library Opening days</h3>
          <sub>What days suit you best for collection and dropoff</sub>
          <LendTimeSlot type="days" :selected-slots.sync="form.times" />
        </div>
        <Button :loading="form.busy" class="absolute bottom-4 right-4" >
          {{ $t('update') }}
        </Button>
      </div>
    </div>
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
      email: '',
      address_line_1: '',
      address_country: '',
      address_city: '',
      address_postcode: '',
      days: [],
      times: []
    }),
    formFields: ['name', 'email', 'address_line_1', 'address_city', 'address_postcode']
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),
  mounted () {
    this.form.name = this.user.name
    this.form.email = this.user.email
  },
  methods: {
    async update () {
      // const { data } = await this.form.post('/api/geolocation/getGeolocationByPostcode')
      const { data } = await this.form.post('/api/geolocation/getGeolocationByUserQuery')

      console.log(data)
    },
    iconByField (field) {
      switch (field) {
        case 'email':
          return 'envelope'
        case 'address_line_1':
          return 'home'
        case 'address_city':
          return 'city'
        case 'address_postcode':
          return 'map-marker-alt'
        case 'name':
          return 'user'
      }
    }
  }
}
</script>

<style lang="scss">
.bookshelf_settings{
  h2{
    @apply mt-10 border-b-2 mb-6 pb-1 text-2xl;
    color: var(--header);
  }
  h3{
    font-family: OpenSans;
    font-size: 18px;
    line-height: 2;
    letter-spacing: normal;
    color: var(--body-dark);
  }
  sub{
    font-family: OpenSans;
    font-size: 1rem;
    line-height: 2;
    letter-spacing: normal;
    color: var(--body-dark);
    margin-bottom: 1rem;
  }
  label{
    font-size: 1rem;
    font-weight: 500;
    color: var(--body-standard);
  }
  &__container{
    display: flex;
    justify-content: space-between;
    & > div{
      @apply w-full md:w-1/2 lg:w-2/5;
      svg{
        color: var(--outline-2);
      }
    }
  }
}
</style>