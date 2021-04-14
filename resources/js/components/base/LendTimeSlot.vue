<template>
  <div class="timeslot">
    <template v-for="(item, index) in typeItems">
      <label :key="`${style}-${index}`" :class="{selected: isSelected(index)}">
        {{ item }}
        <input type="checkbox" :checked="isSelected(index)" @click="select(index)">
      </label>
    </template>
  </div>
</template>

<script>
export default {
  name: 'LendTimeSlot',
  props: {
    selectedSlots: {
      type: Array,
      required: true
    },
    type: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      days: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
      times: ['8.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00']
    }
  },
  computed: {
    typeItems () {
      const items = this[this.type]
      return items
    }
  },
  methods: {
    isSelected (selectedIndex) {
      return this.selectedSlots.includes(selectedIndex)
    },
    select (selectedSlot) {
      const indexInSelectedSlots = this.selectedSlots.indexOf(selectedSlot)
      let updatedSelectedSlots = [...this.selectedSlots]
      // the selected checkbox needs to be added
      if (indexInSelectedSlots === -1) {
        updatedSelectedSlots.push(selectedSlot)
      } else {
        this.$delete(updatedSelectedSlots, indexInSelectedSlots)
      }

      this.$emit('update:selectedSlots', updatedSelectedSlots)
    }
  }
}
</script>

<style lang="scss">
.timeslot {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;

  label {
    padding: 0.50rem 1.25rem;
    border:1px solid #999;
    border-radius:0.25rem;
    cursor: pointer;
    margin-right: 0.75rem;
    margin-bottom: 1rem;
    flex-grow: 1;
    text-align: center;

    &.selected{
      background-color: var(--outline-2);
      color:white;
    }
  }

  input {
    display: none;
  }
}
</style>
