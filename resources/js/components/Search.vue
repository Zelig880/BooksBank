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
          <a href="#" class="btn btn-primary">Lend book</a>
        </div>
      </div>
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
      type: 'ISBN'
    }
  },
  computed: {
    ...mapGetters('books', ['searchedBooks'])
  },
  methods: {
    ...mapActions({
      find: 'bookshelf/find',
    }),
    shortText (text) {

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
