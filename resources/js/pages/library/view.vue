<template>
  <main>
    <div class="w-full border-b-2 pb-8">
      <div class="container mx-auto flex flex-col md:flex-row justify-between">
        <div class="rounded-full border-2 pl-8 pr-12 py-2 flex flex-col relative md:w-7/12">
          <label for="search" class="text-xs text-gray-400 font-bold">You search for:</label>
          <input id="search" v-model="searchText" class="font-bold text-lg" type="text" @keyup.enter="searchHandle">
          <fa icon="search" class="absolute right-4 top-3 text-gray-400" size="2x" @click="searchHandle" />
        </div>
        <div class="md:w-4/12">
          <div class="flex justify-between">
            <span>Distance</span>
            <span>{{ radiusMiles }} Miles</span>
          </div>
          <VueSlider v-model="radiusMiles" v-bind="sliderOptions" @drag-end="searchHandle" />
        </div>
      </div>
    </div>
    <div class="w-full bg-gray-100 py-8">
      <div class="container mx-auto">
        <h2 class="text-2xl mb-8">
          Search result: {{ searchedBook.length }}
        </h2>
        <div class="grid grid-cols-2 gap-4">
          <card
            v-for="result in searchedBook" :key="result.id"
            :title="result.book.title"
            :description="result.book.description"
            :thumbnail="result.book.thumbnail"
            :condition="conditions[result.condition].name"
            :distance="result.bookshelf.distance"
            @click="goToBorrowPage(result.id)"
          />
        </div>
        <h2 v-if="otherBooks.length > 0" class="text-2xl mb-10 pb-12 mt-16 border-b-2">
          Other books available within your radius
        </h2>
        <div class="grid grid-cols-2 gap-4">
          <LibraryViewCard
            v-for="result in otherBooks" :key="result.id"
            :title="result.book.title"
            :description="result.book.description"
            :thumbnail="result.book.thumbnail"
            :condition="conditions[result.condition].name"
            :distance="result.bookshelf.distance"
            @click="goToBorrowPage(result.id)"
          />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import { mapActions, mapGetters, mapState } from 'vuex'
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/default.css'
import LibraryViewCard from '../../components/sections/libraryViewCard.vue'

export default {
  components: {
    VueSlider,
    LibraryViewCard
  },

  data () {
    return {
      searchText: '',
      radiusMiles: 5,
      sliderOptions: {
        min: 1,
        max: 100,
        dotSize: 18,
        tooltip: 'hover',
        tooltipFormatter: '{value} Miles',
        tooltipPlacement: 'bottom'
      }
    }
  },
  computed: {
    ...mapState('library', ['conditions']),
    ...mapGetters('library', ['searchedBook', 'otherBooks'])
  },
  async mounted () {
    this.radiusMiles = Math.round(this.$route.params.radius / 1000)
    this.searchText = this.$route.params.searchTitle || 'All'
    await this.searchHandle()
  },
  methods: {
    ...mapActions('library', ['search']),
    goToBorrowPage (bookshelfItemId) {
      this.$router.push({ name: 'library.borrow', params: { bookshelfItemId } })
    },
    async searchHandle () {
      const query = {
        searchTitle: this.searchTitle,
        longitude: this.$route.params.longitude,
        latitude: this.$route.params.latitude,
        radius: this.radiusMiles * 1000
      }
      await this.search(query)
    }
  }
}
</script>

<style>

</style>
