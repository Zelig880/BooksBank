<template>
  <div>
    <router-link to="bookshelf">BookShelf</router-link>
    <router-view />
  </div>
</template>

<script>

export default {
  scrollToTop: true,
  middleware: 'guest',
  metaInfo () {
    return { title: this.$t('library') }
  }
}
</script>
