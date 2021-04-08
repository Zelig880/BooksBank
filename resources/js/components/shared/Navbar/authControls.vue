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
        <a href="#" class="px-3 py-3 flex items-center text-xs uppercase font-bold leading-snug text-white text-gray-500 hover:opacity-75" @click.prevent="$emit('logout')">
          <fa icon="sign-out-alt" fixed-width />
          {{ $t('logout') }}
        </a>
      </li>
    </template>
    <!-- Non Authenticated -->
    <template v-else>
      <li class="">
        <Anchor theme="none" route-name="login" class="pt-2 mr-6">
          {{ $t('login') }}
        </Anchor>
      </li>
      <li class="">
        <Anchor theme="none" route-name="register" class="pt-2 mr-5">
          {{ $t('register') }}
        </Anchor>
      </li>
    </template>
    <li class="ml-4 hidden md:inline-block">
      <Anchor theme="primary" color="cta" route-name="bookshelf.add">
        Add a book
      </Anchor>
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
