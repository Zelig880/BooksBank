<template>
  <main>
    <h2>Books in your area</h2>
    <div v-for="(result, index) in searchedBooks" :key="index">
      <div class="card" style="width: 18rem;">
        <img :src="result.book.thumbnail" class="card-img-top" :alt="result.book.title">
        <div class="card-body">
          <h4 class="card-title">
            {{ result.book.title }}
          </h4>
          <h5 class="card-title">
            DIstance: {{ result.bookshelf.distance }}
          </h5>
          <p class="card-text short_text">
            {{ result.book.description }}
          </p>
          <button class="btn btn-primary" @click="goToBorrowPage(result.id)">
            Borrow book
          </button>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  middleware: 'guest',

  computed: {
    ...mapGetters('library', ['searchedBooks'])
  },
  async mounted () {
    const query = {
      longitude: this.$route.params.longitude,
      latitude: this.$route.params.latitude,
      radius: this.$route.params.radius
    }
    await this.search(query)
  },
  methods: {
    ...mapActions('library', ['search']),
    goToBorrowPage (bookshelfItemId) {
      this.$router.push({ name: 'library.borrow', params: { bookshelfItemId } })
    }
  }
}
</script>

<style>

</style>