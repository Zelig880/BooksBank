<template>
  <div>
    <h3 class="text-2xl font-semibold mb-3"> {{ $t( 'bookshelfAdd-step3-title' ) }} </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 ml-8">
      <Button v-for="(Type, index) in transactionType" :key="Type.name" @click="selectType(index)" theme="square" :color="(selectedTypeIndex === index) ? 'primary' : ''">{{ Type.name }} </Button>
      <div class="flex" v-if="selectedTypeIndex === 2">
        <label>
          {{ $t( 'bookshelfAdd-step3-price' ) }}
        </label>
        <input type="number" step="0.01" :value="price" class="BookshelfAddBookshelf-field rounded-md border-2 pl-8 pr-6 py-2 block mb-4 mt-1" @keyup="$emit('update:price', $event.target.value)" @change="$emit('update:price', $event.target.value)">
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex'

export default {
  name: 'BookshelfAddStep2',
  props: {
    disabled: Boolean
  },
  data () {
    return {
      selectedTypeIndex: -1,
      price: 0
    }
  },
  computed: {
    ...mapState('bookshelf', ['transactionType'])
  },
  methods: {
    ...mapActions({
      find: 'bookshelf/find'
    }),
    selectType (index) {
      if (this.disabled) return
      this.selectedTypeIndex = index
      this.$emit('update:type', index)
    }
  }
}
</script>

<style>

</style>