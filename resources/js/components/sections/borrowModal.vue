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
            <date-picker :is-expanded="true" title-position="left" :value="minDate" :min-date="minDate" :max-date="maxDate" @dayclick="onDayClick" />
          </div>
          <div class="w-full md:w-2/6 pr-4">
            <!-- sc88: make this dynamic -->
            <p class="mb-3">Tuesday the xx of xxx</p>
            <div class="time selected">8.00 - 10.00</div>
            <div class="time">10.00 - 12.00</div>
            <div class="time">12.00 - 14.00</div>
            <div class="time">14.00 - 16.00</div>
            <div class="time">16.00 - 18.00</div>
            <div class="time">18.00 - 20.00</div>
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
          <!-- sc88: make this dynamic -->
          <p>Collection Date</p>
          <h2>Collection time:</h2>
          <!-- sc88: make this dynamic -->
          <p>Collection Time</p>
          <hr>
          <h2>Book return date:</h2>
          <!-- sc88: make this dynamic -->
          <p>Bok return date</p>
          <!-- sc88: need to emit the selected date and time -->
          <Button @click="$emit('close')">Send Request</Button>
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
