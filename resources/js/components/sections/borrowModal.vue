<template>
  <Modal :show="show">
    <template v-slot:body>
      <date-picker :min-date="minDate" :max-date="maxDate" @dayclick="onDayClick" />
    </template>
  </Modal>
</template>

<script>
import { DateTime } from 'luxon'

export default {
  props: {
    show: {
      type: Boolean,
      required: true
    }
  },
  data () {
    return {
      minDate: DateTime.now(),
      maxDate: DateTime.now().plus({ weeks: 2 })
    }
  },
  methods: {
    onDayClick (day) {
      console.log(day)
    }
  }
}
</script>

<style>

</style>
