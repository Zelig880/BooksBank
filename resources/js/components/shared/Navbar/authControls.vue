<template>
  <ul class="flex flex-col lg:flex-row list-none ml-auto">
    <!-- Authenticated -->
    <template v-if="authenticated">
      <li class="">
        <router-link :to="{ name: 'settings.profile' }" class="px-3 py-3 flex items-center text-xs uppercase font-bold leading-snug text-white text-gray-500 hover:opacity-75" href="#">
          <fa icon="cog" fixed-width />
          {{ $t('settings') }}
        </router-link>
      </li>
      <li>
        <a href="#" @click.prevent="$emit('logout')" class="px-3 py-3 flex items-center text-xs uppercase font-bold leading-snug text-white text-gray-500 hover:opacity-75" >
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
    <li class="ml-4">
      <Link class="px-4 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white text-gray-700 hover:opacity-75" routeName="bookshelf.add">
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
