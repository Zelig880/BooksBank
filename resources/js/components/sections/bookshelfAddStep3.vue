<template>
  <div>
    <h3 class="text-2xl font-semibold mb-3"> {{ $t( 'bookshelfAdd-step3-title' ) }} </h3>
    <div class="grid grid-cols-2 gap-5">
      <Button v-for="(Type, index) in transactionType" :key="Type.name" @click="selectType(index)" theme="square" :color="(selectedTypeIndex === index) ? 'primary' : ''">{{ Type.name }} </Button>
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
      selectedTypeIndex: -1
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
      this.$emit('select', index)
    }
  }
}
</script>

<style>

</style>