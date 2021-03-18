<template>
  <div>
    <h2 class="mb-4 text-center font-black text-gray-700 text-2xl">
      {{ $t('bookshelfAdd-title') }}
    </h2>
    <p class="text-lg">{{ $t('bookshelfAdd-title') }}</p>
    <BookshelfAddSteps :currentStep="currentStep" />
    <Button @click="step(1)">Start Now</Button>
    <label for="search">{{ $t('search_book') }}</label>
    <input id="search" v-model="text" type="text">
    <button @click="find(text)">
      Find
    </button>
    <hr>
    <div v-for="(book, index) in searchedBook" :key="index">
      <div class="card" style="width: 18rem;">
        <img :src="book.thumbnail" class="card-img-top" :alt="book.title">
        <div class="card-body">
          <h5 class="card-title">
            {{ book.title }}
          </h5>
          <p class="card-text short_text">
            {{ book.description }}
          </p>
          <button class="btn btn-primary" @click="showLendForm(index)">
            Lend book
          </button>
        </div>
      </div>
    </div>
    <div v-show="showLend">
      <label for="condition">{{ $t('condition') }}</label>
      <select id="condition" v-model="selectedBook.condition">
        <option value="0">
          Very good
        </option>
        <option value="1">
          Good
        </option>
        <option value="2">
          Acceptable
        </option>
        <option value="3">
          Poor
        </option>
      </select>
      <label for="status">{{ $t('book_status') }}</label>
      <select id="status" v-model="selectedBook.status">
        <option value="0">
          Available
        </option>
        <option value="1">
          Not Available
        </option>
      </select>
      <button class="btn btn-primary" @click="addToBookshelf">
        Add to bookshelf
      </button>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import BookshelfAddSteps from '../../components/sections/bookshelfAddSteps.vue'

export default {
  name: 'Add',
  components: {
    BookshelfAddSteps
  },
  data () {
    return {
      text: '',
      showLend: false,
      selectedBook: {
        status: '',
        condition: '',
        bookIndex: 0
      },
      currentStep: 0
    }
  },
  computed: {
    ...mapGetters('bookshelf', ['searchedBook'])
  },
  methods: {
    ...mapActions({
      find: 'bookshelf/find',
      addBook: 'bookshelf/add_book'
    }),
    async addToBookshelf () {
      await this.addBook(this.selectedBook)
      this.showLend = true
    },
    showLendForm (index) {
      this.selectedBook.bookIndex = index
      this.showLend = true
    },
    step (index) {
      this.currentStep = index
    }
  }
}
</script>

<style>
.short_text{
  overflow: hidden;
  white-space: nowrap;
  -o-text-overflow: ellipsis;
  -ms-text-overflow: ellipsis;
  text-overflow: ellipsis;
  width: auto;
}
</style>
