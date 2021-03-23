<template>
  <div>
    <div class="rounded-full border-2 pl-8 pr-12 py-2 flex flex-col relative md:w-7/12">
      <label for="search" class="text-xs text-gray-400 font-bold">{{ $t( 'bookshelfAdd-step1-search-label' ) }}</label>
      <input id="search" v-model="searchText" class="font-bold text-lg" type="text" @keyup.enter="find(searchText)">
      <fa icon="search" class="absolute right-4 top-3 text-gray-400" size="2x" @click="find(searchText)" />
    </div>
    <div v-if="searchedBook">
      <h2>Your search result</h2>
      <div class="grid grid-cols-2 gap-4">
        <bookshelf-add-card
          v-for="result in searchedBook" :key="result.id"
          :title="result.title"
          :description="result.description"
          :thumbnail="result.thumbnail"
          :ISBN="result.ISBN"
          @click="$emit('select', result)"
        />
      </div>
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

<style>

</style>