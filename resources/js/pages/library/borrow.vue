<template>
  <div>
    <div class="card" style="width: 18rem;">
      <img :src="selectedBook.book.thumbnail" class="card-img-top" :alt="selectedBook.book.title">
      <div class="card-body">
        <h4 class="card-title">
          {{ selectedBook.book.title }}
        </h4>
        <p class="card-text short_text">
          {{ selectedBook.book.description }}
        </p>
        <button class="btn btn-primary" @click="request(selectedBook.id)">
          Borrow book
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  middleware: 'auth',
  data () {
    return {
      selectedBook: null
    }
  },
  computed: {
  },
  async mounted () {
    const data = await this.fetchByBookshelfItemId(this.$route.params.bookshelfItemId)
    if (data.success) this.selectedBook = data.result
  },
  methods: {
    ...mapActions('bookshelf', ['fetchByBookshelfItemId']),
    ...mapActions('ledge', ['request'])
  }
}
</script>

<style>

</style>