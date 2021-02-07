<template>
  <div>
    <router-link to="bookshelf">BookShelf</router-link>
    <router-view />
  </div>
</template>

<script>

export default {
  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
