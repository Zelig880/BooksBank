<template>
  <div class="mt-8 mb-11 BookshelfAddBookshelf">
    <h2 for="search" class="text-2xl font-semibold mb-3">
      {{ $t( 'bookshelfAddBookshelf-heading' ) }}
    </h2>
    <div class="pl-7 relative">
      <label>
        {{ $t( 'bookshelfAddBookshelf-address' ) }}
      </label>
      <input :value="addressLine1" @change="$emit('update:addressLine1', $event.target.value)" class="BookshelfAddBookshelf-field rounded-md border-2 pl-8 pr-6 py-2 block mb-4 mt-1">
      <label>
        {{ $t( 'bookshelfAddBookshelf-postcode' ) }}
      </label>
      <input :value="postcode" @change="$emit('update:postcode', $event.target.value)" class="BookshelfAddBookshelf-field rounded-md border-2 pl-8 pr-6 py-2 block mb-4 mt-1">
    </div>
  </div>
</template>

<script>
export default {
  name: 'BookshelfAddNoBookshelfBanner',
  props: {
    addressLine1: {
      type: String,
      required: true
    },
    postcode: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss">
.BookshelfAddBookshelf{
  position: relative;
  &-field {
    position: relative;
    input{
      background-color: white !important;
    }
  }
  &-result{
    position: absolute;
    width: 704px;
    top:64px;
    left: 0px;
    @apply border-2 rounded-md bg-white;
  }
  &-icon{
    float:right;
    cursor: pointer;
  }
}
</style>
