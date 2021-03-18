<template>
  <div :class="themeClass" @click="$emit('click')">
    <slot />
  </div>
</template>

<script>
const themes = ['rounded']

export default {
  name: 'Button',
  props: {
    theme: {
      type: String,
      required: false,
      default: 'rounded',
      validator: value => themes.includes(value)
    }
  },
  computed: {
    themeClass () {
      return `button button-${this.theme}`
    }
  }
}
</script>

<style lang="scss">
.button{
  display: inline-block;
  cursor: pointer;
}
.button-rounded{
  @apply items-center text-xs uppercase font-bold text-gray-700 hover:opacity-75 rounded-full py-3 px-6 bg-gray-200;
}
</style>
