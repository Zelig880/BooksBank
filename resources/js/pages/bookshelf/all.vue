<template>
  <div class="mt-14">
    <h3 class="font-sans text-2xl font-bold mb-6">{{ $t('bookshelfAll-BooksYouAreReading') }}</h3>
    <div class="grid grid-cols-4 gap-6">
      <div v-for="(item, index) in borrowedWithDetails" :key="index">
        <img :src="item.book.thumbnail" class="card-img-top" :alt="item.book.title">
        <div class="card-body">
          <h5 class="card-title">
            {{ item.book.title }}
          </h5>
          <p class="card-text short_text">
            ISBN: {{ item.book.ISBN }}
          </p>
        </div>
      </div>
    </div>
    <h3 class="font-sans text-2xl font-bold mt-10 mb-6">{{ $t('bookshelfAll-BookYouOwn') }}</h3>
    <div class="grid grid-cols-4 gap-6">
      <div v-for="(item, index) in items" :key="index">
        <img :src="item.book.thumbnail" class="card-img-top" :alt="item.book.title">
        <div class="card-body">
          <h5 class="card-title">
            {{ item.book.title }}
          </h5>
          <p class="card-text short_text">
            ISBN: {{ item.book.ISBN }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'All',
  data () {
    return {
    }
  },
  computed: {
    ...mapGetters('ledge', ['borrowedWithDetails']),
    ...mapGetters('bookshelf', ['items'])
  },
  mounted () {
    this.getAllLedge()
    this.getAllBookshelf()
  },
  methods: {
    ...mapActions({
      getAllLedge: 'ledge/getAll',
      getAllBookshelf: 'bookshelf/getAll'

    })
  }
}
</script>

<style>

</style>
