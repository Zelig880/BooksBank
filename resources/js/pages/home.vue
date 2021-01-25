<template>
  <router-link to="bookshelf">BookShelf</router-link>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
