<template>
  <div class="h-full">
    <router-view class="h-full" />
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
