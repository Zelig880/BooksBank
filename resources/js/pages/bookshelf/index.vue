<template>
  <div>
    <div class="bookshelf-index__header">
      <div class="container mx-auto flex relative h-full">
        <div class="mt-9 ml-5">
          <div class="text-gray-400">
            User
          </div>
          <div class="font-lora text-4xl md:text-6xl mb-2">
            {{ user.name }}
          </div>
          <div
            v-if="currentBookshelf"
            class="text-blue-600 font-sans hidden md:block"
          >
            {{ currentBookshelf.address_line_1 }}, {{ currentBookshelf.city }},
            {{ currentBookshelf.postcode }}
          </div>
        </div>
        <div class="absolute right-2 bottom-0 text-xs md:text-base">
          <router-link
            class="bookshelf-index__button"
            :class="{
              'bookshelf-index__button--selected':
                $route.name === 'bookshelf.all',
            }"
            :to="{ name: 'bookshelf.all' }"
          >
            My Library
          </router-link>
          <router-link
            class="bookshelf-index__button"
            :class="{
              'bookshelf-index__button--selected':
                $route.name === 'bookshelf.info',
            }"
            :to="{ name: 'bookshelf.info' }"
          >
            My Dashboard
          </router-link>
          <router-link
            class="bookshelf-index__button"
            :class="{
              'bookshelf-index__button--selected':
                $route.name === 'bookshelf.settings',
            }"
            :to="{ name: 'bookshelf.settings' }"
          >
            My Bookshelf
          </router-link>
        </div>
      </div>
    </div>
    <div class="bookshelf-index__container container mx-auto p-2">
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
  &__button {
    @apply rounded-t-lg px-2 md:px-7 py-4 font-semibold inline-block;
    background-color: var(--outline);
    color: white;
    &--selected {
      @apply bg-white font-semibold text-gray-700;
    }
  }
}
</style>
