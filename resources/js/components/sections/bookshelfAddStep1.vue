<template>
  <div class="mt-8 bokshelfAddStep1">
    <h3 class="text-xl font-bold">Add ISBN or book title</h3>
    <div class="bokshelfAddStep1-field rounded-sm border-2 pl-8 pr-12 py-2 flex flex-col relative w-full">
      <label for="search" class="text-xs text-gray-400 font-bold">{{ $t( 'bookshelfAdd-step1-search-label' ) }}</label>
      <input id="search" v-model="searchText" class="font-bold text-lg" type="text" @keyup.enter="find(searchText)">
      <fa icon="search" class="absolute right-4 top-3 text-gray-400" size="2x" @click="find(searchText)" />
      <perfect-scrollbar v-if="searchedBook.length > 0" class="bokshelfAddStep1-result">
        <bookshelf-add-card
          v-for="result in searchedBook" :key="result.id"
          :title="result.title"
          :description="result.description"
          :thumbnail="result.thumbnail"
          :ISBN="result.ISBN"
          @click="$emit('select', result)"
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
  data () {
    return {
      searchText: ''
    }
  },
  computed: {
    ...mapGetters('bookshelf', ['searchedBook'])
  },
  methods: {
    ...mapActions({
      find: 'bookshelf/find'
    })
  }
}
</script>

<style lang="scss">
.bokshelfAddStep1{
  position: relative;

  &-field {
    position: relative;
  }
  &-result{
    position: absolute;
    width: 704px;
    top:64px;
    left: 0px;
    @apply border-2 rounded-md bg-white;
  }
  //height of container for perfect scrollbar
  .ps {
    height:500px;
  }
}
</style>