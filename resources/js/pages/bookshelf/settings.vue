<template>
  <div class="bookshelf_settings">
    <h2 class="">
      {{ $t("settings_yourInfo") }}
    </h2>
    <p class="bookshelf_settings__subhead Light-backgroundBody-textBody-small">
      {{ $t("settings_beSafe") }} <Anchor theme="none" route-name="safe">
        Read more
      </Anchor>
    </p>
    <form
      class="bookshelf_settings__container"
      @submit.prevent="update"
      @keydown="form.onKeydown($event)"
    >
      <div>
        <template v-for="field in formFields">
          <div :key="field">
            <label>{{ $t(field) }}:</label>
            <div class="w-full border-b-2 py-4 px-4 mb-8 flex items-center">
              <fa :icon="iconByField(field)" fixed-width />
              <input
                v-model="form[field]"
                :class="{ 'is-invalid': form.errors.has(field) }"
                class="w-full ml-4"
                type="text"
                :name="field"
                :placeholder="$t(field)"
              >
              <has-error :form="form" :field="field" />
            </div>
          </div>
        </template>
      </div>
      <div class="relative">
        <div>
          <h3 class="text-xl font-semibold">
            My Library Opening type
          </h3>
          <sub>What times are you most likely to be at your preferred meeting point for books collection and
            dropoff?</sub>
          <LendTimeSlot
            type="times"
            :selected-slots.sync="form.opening_hours"
          />
        </div>
        <div>
          <h3 class="text-xl font-semibold">
            My Library Opening days
          </h3>
          <sub>What days suit you best for collection and dropoff</sub>
          <LendTimeSlot type="days" :selected-slots.sync="form.opening_days" />
        </div>
        <Button :loading="form.busy" class="mx-auto" @click="update">
          {{ $t("update") }}
        </Button>
      </div>
    </form>
  </div>
</template>

<script>
import Form from 'vform'
import { mapActions, mapGetters } from 'vuex'
import Swal from 'sweetalert2'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      address_line_1: '',
      city: '',
      postcode: '',
      opening_days: [],
      opening_hours: [],
      longitude: null,
      latitude: null,
      delivery: 0 // This is the value for Dropoff delivery. We Hardcode t for now
    }),
    formFields: ['address_line_1', 'city', 'postcode']
  }),

  computed: mapGetters({
    currentBookshelf: 'bookshelf/currentBookshelf'
  }),

  async mounted () {
    await this.getCurrent()
    for (const key in this.currentBookshelf) {
      if (Object.hasOwnProperty.call(this.currentBookshelf, key)) {
        const element = this.currentBookshelf[key]
        if (element) this.form[key] = element
      }
    }
  },

  methods: {
    ...mapActions('bookshelf', ['getCurrent', 'updateOrCreate']),
    async update () {
      var { data: result } = await this.form.post(
        '/api/geolocation/getGeolocationByUserQuery'
      )

      if (!result || !result[0]) {
        Swal.fire({
          type: 'error',
          title: 'Your location could not be found',
          text: 'The server was not able to find your addres location!'
        })
      }

      this.form.longitude = result[0].lon
      this.form.latitude = result[0].lat

      const response = await this.updateOrCreate(this.form)

      if (response) {
        Swal.fire({
          type: 'success',
          title: 'All done',
          text: 'Your information have been updated!'
        })
      }
    },
    iconByField (field) {
      switch (field) {
        case 'email':
          return 'envelope'
        case 'address_line_1':
          return 'home'
        case 'city':
          return 'city'
        case 'postcode':
          return 'map-marker-alt'
        case 'name':
          return 'user'
      }
    }
  }
}
</script>

<style lang="scss">
.bookshelf_settings {
  margin-bottom: 50px;
  h2 {
    @apply mt-10 mb-2 pb-1 text-2xl;
    color: var(--header);
  }
  &__subhead{
    @apply border-b-2 mb-6 pb-1;
  }
  h3 {
    font-family: OpenSans;
    font-size: 18px;
    line-height: 2;
    letter-spacing: normal;
    color: var(--body-dark);
  }
  sub {
    font-family: OpenSans;
    font-size: 1rem;
    line-height: 2;
    letter-spacing: normal;
    color: var(--body-dark);
    margin-bottom: 1rem;
  }
  label {
    font-size: 1rem;
    font-weight: 500;
    color: var(--body-standard);
  }
  &__container {
    display: flex;
    justify-content: space-between;
    & > div {
      @apply w-full md:w-1/2 lg:w-2/5;
      svg {
        color: var(--outline-2);
      }
    }
  }
}

@media (max-width: 768px) {
  .bookshelf_settings {
    &__container {
      flex-direction: column;
    }
  }
}
</style>
