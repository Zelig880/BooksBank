<template>
  <article class="py-14 mb-10">
    <div class="container mx-auto h-auto">
      <div class="mb-6 text-center flex flex-col content-center items-center justify-center">
        <h2 class="text-3xl text-white font-medium mb-4">
          {{ $t('welcomeJoin-title') }}
        </h2>
        <p class="text-white md:w-6/12 mb-10">
          {{ $t('welcomeJoin-paragraph') }}
        </p>
        <form class="md:bg-white md:w-6/12 w-full md:rounded-md md:flex" @submit.prevent="handleForm" @keydown="form.onKeydown($event)">
          <input class="block bg-white rounded-md md:rounded-r-none md:flex-grow mt-6 md:mt-0 w-11/12 md:w-auto mx-auto py-4 px-6" v-model="form.address" type="text" placeholder="Your email address">
          <button class="block bg-gray-800 text-white font-bold rounded-md md:rounded-l-none flex-grow mt-6 md:mt-0 w-11/12 md:w-1/6 mx-auto py-4">
            {{ $t('register_cta') }}
          </button>
        </form>
      </div>
    </div>
  </article>
</template>

<script>
import Form from 'vform'
import { mapActions } from 'vuex'

export default {

  data: () => ({
    form: new Form({
      address: ''
    })
  }),

  methods: {
    ...mapActions('newsletter', ['createContact']),
    handleForm () {
      if (!this.form.address) return
      this.createContact(this.form.address)
    }
  }
}
</script>

<style lang="scss">
  article {
    background-color: #cf6f5f;
  } 
  @media (min-width: 768px) {
    article {
      background-image: url('/assets/img/swinging.svg');
      background-repeat: no-repeat;
      background-size: contain;
    }
  }

</style>
