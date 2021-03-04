<template>
  <router-link class="rounded-full py-3 px-6 bg-white" :to="{ name: routeName}">
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
