<template>
  <div>
    <div class="bookshelf-index__header">
      <div class="container mx-auto flex relative h-full">
        <div class="mt-9">
          <div class="text-gray-400">
            User
          </div>
          <div class="font-lora text-6xl mb-2">
            {{ user.name }}
          </div>
          <div class="text-blue-600 font-sans">
            {{ currentBookshelf.address_line_1 }}, {{ currentBookshelf.city }}, {{ currentBookshelf.postcode }}
          </div>
        </div>
        <div class=" absolute right-0 bottom-0">
          <router-link class="bookshelf-index__button" :class="{ 'bookshelf-index__button--selected': $route.name === 'bookshelf.all'}" :to="{ name: 'bookshelf.all' }">
            My Library
          </router-link>
          <router-link class="bookshelf-index__button" :class="{ 'bookshelf-index__button--selected': $route.name === 'bookshelf.info'}" :to="{ name: 'bookshelf.info' }">
            My Dashboard
          </router-link>
          <router-link class="bookshelf-index__button" :class="{ 'bookshelf-index__button--selected': $route.name === 'bookshelf.settings'}" :to="{ name: 'bookshelf.settings' }">
            My Bookshelf
          </router-link>
        </div>
      </div>
    </div>
    <div class="bookshelf-index__container container mx-auto">
      <router-view />
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  middleware: 'auth',
  computed: mapGetters({
    user: 'auth/user',
    currentBookshelf: 'bookshelf/currentBookshelf'
  }),
  async beforeMount () {
    await this.getCurrent()
  },
  methods: mapActions('bookshelf', ['getCurrent'])
}
</script>

<style lang="scss">
.bookshelf-index {
  &__header {
    height: 200px;
    background-color: #f6f3f1;
    position: relative;
  }
  &__container {
    min-height: 500px;
  }
  &__button{
    @apply bg-gray-400 rounded-t-lg text-blue-600 py-4 px-7 font-semibold inline-block;
    &--selected{
      @apply bg-white font-semibold text-gray-700;
    }
  }
}
</style>
