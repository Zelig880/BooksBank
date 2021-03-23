<template>
  <div>
    <h3 class="text-2xl font-bold"> {{ $t( 'bookshelfAdd-step2-title' ) }} </h3>
    <p> {{ $t( 'bookshelfAdd-step2-description' ) }} </p>
    <div>
      <div v-for="(condition, index) in conditions" :key="condition.name" @click="$emit('select', index)" class="flex w-10/12 mx-auto mb-6 cursor-pointer border-2 rounded-md hover:bg-gray-200 p-12">
        <h4 class="font-bold text-xl w-2/6">{{ condition.name }} </h4>
        <p>{{ condition.description }} </p>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapState } from 'vuex'

export default {
  name: 'BookshelfAddStep2',
  computed: {
    ...mapState('library', ['conditions']),
    ...mapGetters('bookshelf', ['searchedBook'])
  },
  methods: {
    ...mapActions({
      find: 'bookshelf/find'
    })
  }
}
</script>

<style>

</style>