<template>
  <div class="mt-8 mb-11 bokshelfAddStep1">
    <label for="search" class="text-2xl font-semibold mb-3">{{ $t( 'bookshelfAdd-step1-search-label' ) }}</label>
    <div class="bokshelfAddStep1-field rounded-md border-2 mx-2 md:ml-7 mt-4 pl-8 pr-6 py-2 flex flex-col relative">
      <div class="flex">
        <input id="search" v-model="searchText" class="font-bold text-lg w-auto md:w-4/5" type="text" placeholder="Enter book name" :disabled="disabled" autocomplete="off" @keyup.enter="find(searchText)">
        <fa v-if="searchText.length > 0" icon="times" class="bokshelfAddStep1-icon mt-1" size="lg" @click="resetSearch" />
        <Button class="bokshelfAddStep1-button" @click="find(searchText)">
          Search
        </Button>
      </div>
      <perfect-scrollbar v-if="searchedBook.length > 0" class="bokshelfAddStep1-result">
        <bookshelf-add-card
          v-for="result in searchedBook" :key="result.id"
          :title="result.title"
          :authors="result.authors"
          :description="result.description"
          :thumbnail="result.thumbnail"
          @click="selectBook(result)"
        />
      </perfect-scrollbar>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import BookshelfAddCard from './bookshelfAddCard.vue'
export default {
  name: 'BookshelfAddStep1',
  components: { BookshelfAddCard },
  props: {
    disabled: Boolean
  },
  data () {
    return {
      searchText: ''
    }
  },
  computed: {
    ...mapGetters('bookshelf', ['searchedBook'])
  },
  beforeDestroy () {
    this.resetSearch()
  },
  methods: {
    ...mapActions({
      find: 'bookshelf/find',
      reset: 'bookshelf/reset'
    }),
    selectBook (book) {
      this.searchText = book.title
      this.$emit('select', book)
      this.reset()
    },
    resetSearch () {
      this.reset()
      this.searchText = ''
    }
  }
}
</script>

<style lang="scss">
.bokshelfAddStep1{
  position: relative;
  &-field {
    position: relative;
    input{
      background-color: white !important;
    }
  }
  &-result{
    position: absolute;
    max-width: 704px;
    top:64px;
    left: 0px;
    @apply border-2 rounded-md bg-white;
  }
  &-icon{
    // position:absolute;
    // right:175px;
    // top:13px;
    @apply md:h-8;
    cursor: pointer;
  }
  &-button{
    @apply absolute top-14 right-3 md:relative md:top-0 md:right-0 md:ml-4;
  }
}
//height of container for perfect scrollbar
.ps {
  height:500px;
}
</style>
