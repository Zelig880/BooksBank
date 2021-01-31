<template>
  <div>
    <button @click="search({latitude: 51.67139816, longitude: -4.00746388, radius: 3000})">
      Search with hardcoded location
    </button>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'LibrarySearch',
  methods: {
    ...mapActions('library', ['search'])
  }
}
</script>

<style>

</style>
