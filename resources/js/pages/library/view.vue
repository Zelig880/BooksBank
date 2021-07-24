<template>
  <main class="flex flex-col">
    <div class="w-full border-b-2 pb-8">
      <div class="container px-6 lg:px-0 lg:mx-auto flex flex-col md:flex-row justify-between">
        <div class="rounded-full border-2 pl-8 pr-12 py-2 flex flex-col relative md:w-7/12">
          <label for="search" class="text-xs text-gray-400 font-bold">{{ $t('libraryBorrow-searchTitleLabel') }}:</label>
          <input id="search" v-model="searchTitle" class="font-bold text-lg" type="text" @keyup.enter="searchHandle">
          <fa icon="search" class="absolute right-4 top-3 text-gray-400" size="2x" @click="searchHandle" />
        </div>
        <div class="md:w-4/12 mt-10 sm:mt-0">
          <div class="flex justify-between">
            <span>Distance</span>
            <span>{{ radiusMiles }} Miles</span>
          </div>
          <VueSlider v-model="radiusMiles" v-bind="sliderOptions" @drag-end="searchHandle" />
        </div>
      </div>
    </div>
    <div class="w-full flex-1 bg-gray-100 py-8 mb-8">
      <div class="container px-6 lg:px-0 lg:mx-auto">
        <template v-if="loading">
          <img class="mx-auto" src="/assets/img/loading.gif" alt="loading gif">
        </template>
        <template v-else>
          <h2 class="text-2xl mb-3">
            {{ $t('libraryBorrow-filterBy') }}
          </h2>
          <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-2">
            <vSelect
              :options="categories"
              :get-option-key="value => filterValueForSelect(value, 'id')"
              :get-option-label="value => filterValueForSelect(value, 'name')"
              name="category"
              placeholder="Category"
              @input="value => updateFilter({ value, filter: 'category'})"
            />
            <vSelect
              :options="conditions"
              :get-option-key="value => filterValueForSelect(value, 'id')"
              :get-option-label="value => filterValueForSelect(value, 'name')"
              name="condition"
              placeholder="Condition"
              @input="value => updateFilter({ value, filter: 'condition'})"
            />
            <vSelect
              :options="transactionType"
              :get-option-key="value => filterValueForSelect(value, 'id')"
              :get-option-label="value => filterValueForSelect(value, 'name')"
              name="transaction"
              placeholder="Load or Get Free"
              @input="value => updateFilter({ value, filter: 'transaction'})"
            />
          </div>
          <h2 class="text-2xl mb-8">
            {{ $t('libraryBorrow-searchBooks') }}: {{ searchedBook.length }}
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <template v-if="searchedBook.length !== 0">
              <LibraryViewCard
                v-for="result in searchedBook" :key="result.id"
                :title="result.book.title"
                :description="result.book.description"
                :thumbnail="result.book.thumbnail"
                :condition="conditions[result.condition].name"
                :transaction-type="transactionType[result.type].nameForCustomer"
                :distance="result.bookshelf.distance"
                @click="goToBorrowPage(result.id)"
              />
            </template>
            <div v-else class="flex-col col-span-2 no-books-container">
              <img alt="Pile of books" src="/assets/img/pile-of-books.png" class="m-auto mb-6">
              <h3 class="Light-backgroundH1---h6H4 font-bold">
                {{ $t('libraryBorrow-noBooks-heading') }}
              </h3>
              <p class="Light-backgroundH1---h6H4">
                {{ $t('libraryBorrow-noBooks') }}
              </p>
              <div class="flex flex-col md:flex-row items-center justify-center mt-6 mb-3">
                <a class="twitter" target="_blank" href="https://twitter.com/intent/tweet?url=https://booksbank.co.uk&text=Come%20and%20join%20@BooksBank%20and%20give%20your%20books%20another%20life:">Share on twitter</a>
                <a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://booksbank.co.uk">Share on facebook</a>
                <a class="pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=https://booksbank.co.uk&media=&description=Come%20and%20join%20@BooksBank%20and%20give%20your%20books%20another%20life:">Share on pinterest</a>
              </div>
            </div>
          </div>
          <h2 v-if="otherBooks.length > 0" class="text-2xl mb-10 pb-12 mt-16 border-b-2">
            {{ $t('libraryBorrow-searchOtherBooks') }}
          </h2>
          <div class="grid grid-cols-2 gap-4">
            <LibraryViewCard
              v-for="result in otherBooks" :key="result.id"
              :title="result.book.title"
              :description="result.book.description"
              :thumbnail="result.book.thumbnail"
              :condition="conditions[result.condition].name"
              :transaction-type="transactionType[result.type].nameForCustomer"
              :distance="result.bookshelf.distance"
              @click="goToBorrowPage(result.id)"
            />
          </div>
        </template>
      </div>
    </div>
  </main>
</template>

<script>
import { mapActions, mapGetters, mapState } from 'vuex'
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/default.css'
import LibraryViewCard from '../../components/sections/libraryViewCard.vue'
import vSelect from 'vue-select'

export default {
  components: {
    VueSlider,
    LibraryViewCard,
    vSelect
  },

  data () {
    return {
      searchTitle: '',
      radiusMiles: 15,
      showModal: true,
      sliderOptions: {
        min: 1,
        max: 50,
        dotSize: 18,
        tooltip: 'hover',
        tooltipFormatter: '{value} Miles',
        tooltipPlacement: 'bottom'
      }
    }
  },
  computed: {
    ...mapState('library', ['conditions', 'categories']),
    ...mapState('bookshelf', ['transactionType']),
    ...mapGetters('library', ['searchedBook', 'otherBooks', 'loading'])
  },
  async mounted () {
    this.radiusMiles = this.$route.params.radius
    this.searchTitle = this.$route.params.searchTitle || 'All'
    await this.searchHandle()
  },
  methods: {
    ...mapActions('library', ['search', 'updateFilter']),
    goToBorrowPage (bookshelfItemId) {
      this.$router.push({ name: 'library.borrow', params: { bookshelfItemId } })
    },
    async searchHandle () {
      const query = {
        searchTitle: this.searchTitle,
        longitude: this.$route.params.longitude,
        latitude: this.$route.params.latitude,
        radius: this.radiusMiles
      }
      await this.search(query)
    },
    filterValueForSelect (value, key) {
      return value[key]
    }
  }
}
</script>

<style lang="scss">
.no-books-container{
  & h3, & p {
    color: #777887;
    text-align: center;
  }
  & .twitter,& .facebook, & .pinterest{
    width: 179px;
    height: fit-content;
    margin: 10px;
    padding: 10px 28px 11px;
    border-radius: 4px;
    background-color: #3b5799;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    color: #ffffff;
  }
  .facebook {
    background-color: #1da1f2;
  }
  .pinterest {
    background-color: #E60023
  }
}
.vs__dropdown-toggle{
  padding:10px 5px;
}
</style>
