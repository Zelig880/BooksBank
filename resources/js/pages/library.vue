<template>
  <div>
    <router-view />
  </div>
</template>

<script>

export default {
  scrollToTop: true,
  metaInfo () {
    return { title: this.$t('library') }
  }
}
</script>
