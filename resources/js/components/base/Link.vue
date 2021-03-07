<template>
  <router-link class="flex items-center text-xs uppercase font-bold text-gray-700 hover:opacity-75 rounded-full py-3 px-6 bg-gray-200" :to="{ name: routeName}">
    <slot />
  </router-link>
</template>

<script>
export default {
  name: 'Link',
  props: {
    routeName: {
      type: String,
      required: true
    }
  }
}
</script>

<style>

</style>
