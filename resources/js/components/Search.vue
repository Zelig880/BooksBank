<template>
  <div>
    <label for="search">Search:</label>
    <select id="type" v-model="type">
      <option value="isbn">ISBN</option>
      <option value="title">Title</option>
      <option value="author">Author</option>
    </select>
    <input id="search" v-model="text" type="text">
    <button @click="find({type, text})">
      Find
    </button>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'Search',
  data () {
    return {
      text: '',
      type: 'ISBN'
    }
  },
  methods: {
    ...mapActions({
      find: 'books/find'
    })
  }
}
</script>

<style>

</style>
