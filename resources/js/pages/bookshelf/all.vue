<template>
  <div>
    <div v-for="(bookshelf_item, index) in items" :key="index">
      <div class="card" style="width: 18rem;">
        <img :src="bookshelf_item.book.thumbnail" class="card-img-top" :alt="bookshelf_item.book.title">
        <div class="card-body">
          <h5 class="card-title">
            {{ bookshelf_item.book.title }}
          </h5>
          <p class="card-text short_text">
            {{ bookshelf_item.book.description }}
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
    ...mapGetters('bookshelf', ['items'])
  },
  mounted () {
    this.getAll()
  },
  methods: {
    ...mapActions({
      getAll: 'bookshelf/getAll'
    })
  }
}
</script>

<style>

</style>
