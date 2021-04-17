<template>
  <Modal :show="show" @close="$emit('close')">
    <template v-slot:body>
      <div class="borrowModal grid grid-cols-4">
        <div class="col-span-4 md:col-span-3 p-9 flex flex-wrap">
          <div class="flex-grow">
            <h2 class="text-2xl text-gray-700 font-bold" >Collection time available</h2>
            <p class="text-gray-500 mb-12">Find the time that suit you best, from the available list</p>
          </div>
          <div class="w-full md:w-4/6 pr-8">
            <date-picker :disabled-dates='formattedDisableDays' :is-expanded="true" title-position="left" :value="selectedDate" :min-date="minDate" :max-date="maxDate" @dayclick="onDayClick" />
          </div>
          <div v-if="selectedDate" class="w-full md:w-2/6 pr-4">
            <p class="mb-3">Selected Date: {{ selectedDate }}</p>
            <div v-for="(time, index) in times" :key="index" class="time" :class="{ selected: timeSlot === (index) }" @click="onTimeClick(index)">{{ time }}</div>
          </div>
        </div>
        <div class="col-span-4 md:col-span-1 bg-gray-300 p-9">
          <h2>You are borrwing:</h2>
          <!-- sc88: make this dynamic -->
          <p>Book Title</p>
          <!-- sc88: make this dynamic -->
          <p>in CONDITIONTYPE condition</p>
          <hr>
          <!-- sc88: make this dynamic -->
          <p>Borrower Username</p>
          <!-- sc88: make this dynamic -->
          <p>
            <fa icon="map-marker-alt" />
            2000 Miles
          </p>
          <hr>
          <h2>Collection date:</h2>
          <p>{{ selectedDate }}</p>
          <h2>Collection time:</h2>
          <p>{{ times[timeSlot] }}</p>
          <hr>
          <h2>Book return date:</h2>
          <!-- sc88: make this dynamic -->
          <p>Bok return date</p>
          <!-- sc88: need to emit the selected date and time -->
          <Button :disabled="submitDisabled" @click="$emit('close')">Send Request</Button>
        </div>
      </div>
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
      minDate: DateTime.now().plus({ days: 1 }),
      maxDate: DateTime.now().plus({ weeks: 2 }),
      disabledDays: [2, 3, 4],
      selectedDate: null,
      times: ['8.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00'],
      timeSlot: null,
      DaySlot: null
    }
  },
  computed: {
    formattedDisableDays () {
      return { weekdays: this.disabledDays }
    },
    submitDisabled () {
      const dateSelected = !!this.DaySlot
      const timeSelected = !!this.timeSlot

      return !dateSelected || !timeSelected
    }
  },
  methods: {
    onDayClick ({ day, month, year, weekdayPosition }) {
      this.selectedDate = DateTime.fromObject({ day, month, year }).toFormat('cccc, d LLLL')
      this.DaySlot = weekdayPosition
    },
    onTimeClick (timeIndex) {
      this.timeSlot = timeIndex
    }
  }
}
</script>

<style lang="scss">
.borrowModal{
 hr{
   @apply my-6 bg-gray-600;
   height: 2px;
 }
  .time{
    @apply rounded-lg border-2 border-gray-500 mt-2 w-auto px-7 py-4 text-center font-bold;

    &.selected, &:hover{
      @apply bg-gray-500 text-white cursor-pointer;
    }
  }
}

</style>
