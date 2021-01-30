<template>
  <div>
    <label for="search">{{ $t('search_book') }}</label>
    <select id="type" v-model="type">
      <option value="isbn">
        ISBN
      </option>
      <option value="title">
        Title
      </option>
      <option value="author">
        Authors
      </option>
    </select>
    <input id="search" v-model="text" type="text">
    <button @click="find({type, text})">
      Find
    </button>
    <hr>
    <div v-for="(book, index) in searchedBooks" :key="index">
      <div class="card" style="width: 18rem;">
        <img :src="book.thumbnail" class="card-img-top" :alt="book.title">
        <div class="card-body">
          <h5 class="card-title">
            {{ book.title }}
          </h5>
          <p class="card-text short_text">
            {{ book.description }}
          </p>
          <button class="btn btn-primary" @click="showLendForm(index)">Lend book</button>
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
      <button class="btn btn-primary" @click="addToBookshelf">Add to bookshelf</button>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'Search',
  data () {
    return {
      text: '',
      type: 'ISBN',
      showLend: false,
      selectedBook: {
        status: '',
        condition: '',
        bookIndex: 0
      }
    }
  },
  computed: {
    ...mapGetters('bookshelf', ['searchedBooks'])
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
