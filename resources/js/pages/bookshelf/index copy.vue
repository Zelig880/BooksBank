<template>
  <div>
    <div class="bookshelf-index__header">
      <div class="container mx-auto flex relative h-full">
        <div class="mt-9">
          <div class="text-gray-400">
            User
          </div>
          <div class="font-lora text-6xl">
            My Name
          </div>
          <div class="text-blue-600 font-sans">
            Address line 1, line 2
          </div>
        </div>
        <div class=" absolute right-0 bottom-0">
          <router-link class="bookshelf-index__button" :class="{ 'bookshelf-index__button--selected': $route.name === 'bookshelf.all'} " :to="{ name: 'bookshelf/all' }">
            My Library
          </router-link>
          <router-link class="bookshelf-index__button" :to="{ name: 'bookshelf/info' }">
            My Books
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
export default {
  middleware: 'auth'
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
    @apply bg-gray-400 rounded-t-lg text-blue-600 py-4 px-7 font-semibold;
    &--selected{
      @apply bg-white font-semibold;
    }
  }
}
</style>
