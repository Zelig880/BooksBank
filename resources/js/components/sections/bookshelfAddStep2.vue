<template>
  <div>
    <h3 class="text-2xl font-semibold mb-3"> {{ $t( 'bookshelfAdd-step2-title' ) }} </h3>
    <div class="grid grid-cols-2 gap-5"> 
      <Button v-for="(condition, index) in conditions" :key="condition.name" @click="selectCondition(index)" theme="square" :color="(selectedConditionIndex === index) ? 'primary' : ''">{{ condition.name }} </Button>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapState } from 'vuex'

export default {
  name: 'BookshelfAddStep2',
  props: {
    disabled: Boolean
  },
  data () {
    return {
      selectedConditionIndex: -1
    }
  },
  computed: {
    ...mapState('library', ['conditions']),
    ...mapGetters('bookshelf', ['searchedBook'])
  },
  methods: {
    ...mapActions({
      find: 'bookshelf/find'
    }),
    selectCondition (index) {
      if (this.disabled) return
      this.selectedConditionIndex = index
      this.$emit('select', index)
    }
  }
}
</script>

<style>

</style>