<template>
  <ul>
    <!-- Authenticated -->
    <template v-if="authenticated">
      <li class="">
        <router-link :to="{ name: 'settings.profile' }" class="px-3 py-3 flex items-center text-xs uppercase font-bold leading-snug text-white text-gray-500 hover:opacity-75" href="#">
          <fa icon="cog" fixed-width />
          {{ $t('settings') }}
        </router-link>
      </li>
      <li>
        <a href="#" class="px-3 py-3 flex items-center text-xs uppercase font-bold leading-snug text-white text-gray-500 hover:opacity-75" @click.prevent="$emit('logout')" >
          <fa icon="sign-out-alt" fixed-width />
          {{ $t('logout') }}
        </a>
      </li>
    </template>
    <!-- Non Authenticated -->
    <template v-else>
      <li class="">
        <router-link :to="{ name: 'login' }" class="px-3 py-3 flex items-center text-xs uppercase font-bold leading-snug text-white text-gray-500 hover:opacity-75" active-class="active">
          {{ $t('login') }}
        </router-link>
      </li>
      <li class="">
        <router-link :to="{ name: 'register' }" class="px-3 py-3 flex items-center text-xs uppercase font-bold leading-snug text-white text-gray-500 hover:opacity-75" active-class="active">
          {{ $t('register') }}
        </router-link>
      </li>
    </template>
    <li class="ml-4 hidden md:inline-block">
      <Link class="" routeName="bookshelf.add">
      Add a book
      </Link>
    </li>
  </ul>
</template>

<script>
export default {
  props: {
    authenticated: {
      type: Boolean,
      required: true
    }
  }
}
</script>

<style>

</style>
