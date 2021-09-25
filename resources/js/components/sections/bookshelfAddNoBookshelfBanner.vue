<template>
  <div class="bookshelfAddNoBookshelfBanner flex flex-col rounded-md p-4 px-6">
    <h2 class="font-bold text-2xl mb-2">
      {{ $t('bookshelfAddNoBookshelfBanner-title') }}
    </h2>
    <p class="font-semibold" v-html="$t('bookshelfAddNoBookshelfBanner-paragraph')" />
    <video controls src="/assets/video/how-to-add.mp4" />
    <Anchor theme="secondary" route-name="bookshelf.settings" class="mt-4">
      {{ $t('bookshelfAddNoBookshelfBanner-button') }}
    </Anchor>
  </div>
</template>

<script>
export default {
  name: 'BookshelfAddNoBookshelfBanner'
}
</script>

<style lang="scss">
.bookshelfAddNoBookshelfBanner{
  background-color: var(--secondary-3);
}
</style>
