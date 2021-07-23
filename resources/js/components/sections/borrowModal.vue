<template>
  <Modal :show="show" @close="$emit('close')">
    <template v-slot:body>
      <div class="borrowModal grid grid-cols-4">
        <div class="col-span-4 md:col-span-3 p-9 flex flex-wrap">
          <div class="flex-grow">
            <h2 class="text-2xl text-gray-700 font-bold">
              Collection time available
            </h2>
            <p class="text-gray-500 mb-12">
              Find the time that suit you best, from the available list
            </p>
          </div>
          <div class="w-full md:w-4/6 pr-8">
            <h3 class="text-xl text-gray-700 font-semibold">Select a pickup date</h3>
            <date-picker :disabled-dates="formattedDisableDays" :is-expanded="true" title-position="left" :value="selectedDate" :min-date="minDate" :max-date="maxDate" @dayclick="onDayClick" />
          </div>
          <div v-if="selectedDate" class="w-full md:w-2/6 pr-4">
            <h3 class="text-xl text-gray-700 font-semibold">Select a pickup time</h3>
            <p class="mb-3">
              Selected Date: {{ selectedDate }}
            </p>
            <template v-for="(time, index) in times">
              <div v-if="selectedBook.bookshelf.opening_hours.includes(index)" :key="index" class="time" :class="{ selected: timeSlot === (index) }" @click="onTimeClick(index)">
                {{ time }}
              </div>
            </template>
          </div>
        </div>
        <div class="col-span-4 md:col-span-1 bg-gray-300 p-9">
          <h2>You are borrowing:</h2>
          <p class="font-semibold">{{ selectedBook.book.title }}</p>
          <hr>
          <p class="font-semibold">
            <fa icon="map-marker-alt" class="mr-1" />{{ selectedBook.bookshelf.city}}, {{ selectedBook.bookshelf.postcode}}
          </p>
          <sub>The full address will be received by email on approval</sub>
          <hr>
          <h2>Collection date:</h2>
          <p class="font-semibold">{{ selectedDate }}</p>
          <h2>Collection time:</h2>
          <p class="font-semibold">{{ times[timeSlot] }}</p>
          <!-- We just show the return date if the book is of type borrow -->
          <hr>
          <template v-if="selectedBook.type === 0">
            <h2>Book return date:</h2>
            <p class="font-semibold">{{ returnDate.toFormat('yyyy-LL-dd') }}</p>
          </template>
          <Button :disabled="submitDisabled" @click="onSendRequest">
            Send Request
          </Button>
        </div>
      </div>
    </template>
  </Modal>
</template>

<script>
import { mapActions } from 'vuex'
import { DateTime } from 'luxon'
import Swal from 'sweetalert2'

export default {
  middleware: 'auth',
  props: {
    show: {
      type: Boolean,
      required: true
    },
    selectedBook: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      minDate: DateTime.now().plus({ days: 1 }),
      maxDate: DateTime.now().plus({ weeks: 2 }),
      returnDate: DateTime.now().plus({ months: 1 }),
      selectedDate: null,
      times: ['8:00 - 10:00', '10:00 - 12:00', '12:00 - 14:00', '14:00 - 16:00', '16:00 - 18:00', '18:00 - 20:00'],
      timeSlot: null,
      DaySlot: null
    }
  },
  computed: {
    formattedDisableDays () {
      return { weekdays: this.disabledDays }
    },
    submitDisabled () {
      const dateSelected = this.DaySlot === null
      const timeSelected = this.timeSlot === null

      return dateSelected || timeSelected
    },
    disabledDays () {
      const weekDays = [ 1, 2, 3, 4, 5, 6, 7 ]
      return weekDays.filter(day => {
        // We just return the value that are NOT included in the bookshelf
        // we also remove 1 to the weekDay value, as the calendar plugin starts from 1 and the value saved start from 0
        const currentDay = day - 1
        return !this.selectedBook.bookshelf.opening_days.includes(currentDay)
      })
    }
  },
  methods: {
    ...mapActions('ledge', ['request']),
    onDayClick ({ day, month, year, weekdayPosition }) {
      const dateObject = DateTime.fromObject({ day, month, year })
      this.selectedDate = dateObject.toFormat('cccc, d LLLL')
      this.returnDate = dateObject.plus({ months: 1 })
      this.DaySlot = weekdayPosition
    },
    onTimeClick (timeIndex) {
      this.timeSlot = timeIndex
    },
    async onSendRequest () {
      // we need to get the initial hour of the timeslot
      const timeslotHour = this.times[this.timeSlot].split(':')[0]
      const payload = {
        bookshelfItemId: this.selectedBook.id,
        pickup_date: DateTime.fromFormat(this.selectedDate, 'cccc, d LLLL').set({ hour: timeslotHour }).toFormat('yyyy-LL-dd T'),
        return_date: this.returnDate.toFormat('yyyy-LL-dd T')
      }

      try {
        await this.request(payload)
        this.$emit('close')
        Swal.fire({
          type: 'success',
          title: 'Good Job!',
          text: 'Your request has been sent!'
        })
      } catch (error) {
        this.$emit('close')
      }
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
