<template>
  <div class="mt-14">
    <h3 class="font-sans text-2xl font-bold mb-6">Their books</h3>
    <div class="grid grid-cols-4 gap-6">
      <div v-for="(item, index) in borrowed" :key="index">
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
    <h3 class="font-sans text-2xl font-bold mt-10 mb-6">Your books</h3>
    <div class="grid grid-cols-4 gap-6">
      <div v-for="(item, index) in lent" :key="index">
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
    ...mapGetters('ledge', ['borrowed', 'lent'])
  },
  mounted () {
    this.getAll()
  },
  methods: {
    ...mapActions({
      getAll: 'ledge/getAll'
    })
  }
}
</script>

<style>

</style>
