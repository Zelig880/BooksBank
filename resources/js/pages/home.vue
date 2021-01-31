<template>
  <div>
    <router-link to="bookshelf">BookShelf</router-link>
    <librarySearch />
  </div>
</template>

<script>
import librarySearch from './library/librarySearch'

export default {
  middleware: 'auth',
  components:{
    librarySearch
  },
  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
