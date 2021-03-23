<template>
  <div class="container mx-auto flex">
    <div class="w-2/12">
      <h2 class="text-lg font-bold">{{ $t('settings') }}</h2>
      <ul class="">
        <li v-for="tab in tabs" :key="tab.route" class="">
          <router-link :to="{ name: tab.route }" class="nav-link" active-class="active">
            <fa :icon="tab.icon" fixed-width />
            {{ tab.name }}
          </router-link>
        </li>
      </ul>
    </div>

    <div class="w-10/12">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'auth',

  computed: {
    tabs () {
      return [
        {
          icon: 'book',
          name: this.$t('personal_bookshelf'),
          route: 'bookshelf.all'
        },
        {
          icon: 'user',
          name: this.$t('profile'),
          route: 'bookshelf.settings'
        },
        {
          icon: 'search',
          name: this.$t('add_books'),
          route: 'bookshelf.add'
        }
      ]
    }
  }
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
