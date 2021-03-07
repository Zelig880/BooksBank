<template>
  <router-link :class="themeClass" :to="{ name: routeName}">
    <slot />
  </router-link>
</template>

<script>
const themes = ['default', 'rounded']

export default {
  name: 'Anchor',
  props: {
    routeName: {
      type: String,
      required: true
    },
    theme: {
      type: String,
      required: false,
      default: 'default',
      validator: value => themes.includes(value)
    }
  },
  computed: {
    themeClass () {
      return `anchor-${this.theme}`
    }
  }
}
</script>

<style lang="scss">
.anchor-rounded{
  @apply flex items-center text-xs uppercase font-bold text-gray-700 hover:opacity-75 rounded-full py-3 px-6 bg-gray-200;
}
.anchor-default{
  @apply px-3 py-3 flex items-center text-xs uppercase font-bold leading-snug text-gray-500 hover:opacity-75;
}
</style>
