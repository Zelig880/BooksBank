<template>
  <Modal :show="show" @close="$emit('close')">
    <template v-slot:body>
      <div class="borrowModal grid grid-cols-4">
        <div class="col-span-4 md:col-span-3 p-9 flex flex-wrap">
          <div class="flex-grow md:w-full">
            <h2 class="text-2xl text-gray-700 font-bold">
              Get in touch
            </h2>
            <p class="text-gray-500 mb-12">
              Find the time that suit both parties to meet.
            </p>
          </div>
          <div class="w-full md:w-3/6 pr-8">
            <h3 class="text-xl text-gray-700 font-semibold">When would you like to meet:</h3>
            <template v-for="(day, index) in days">
              <div :key="index" class="items" :class="{ selected: daySlot === (index) }" @click="onDayClick(index)">
                {{ day }}
              </div>
            </template>
          </div>
          <div v-if="daySlot !== null" class="w-full md:w-3/6 pr-4">
            <h3 class="text-xl text-gray-700 font-semibold">Select a pickup time</h3>
            <div class="flex flex-wrap">
              <template v-for="(time, index) in times">
                <div :key="index" class="items m-2 flex-grow" :class="{ selected: timeSlot === (index) }" @click="onTimeClick(index)">
                  {{ time }}
                </div>
              </template>
            </div>
          </div>
          <div v-if="timeSlot !== null" class="w-full pr-4">
            <h3 class="text-xl text-gray-700 font-semibold mt-8">Send a message</h3>
            <textarea
              v-model="message"
              class="textarea"
            />
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
          <template v-if="selectedBook.type === 0">
            <h2>Book return date:</h2>
            <p class="font-semibold">{{ returnDate }}</p>
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
      today: DateTime.now().toFormat('yyyy-LL-dd T'),
      returnDate: DateTime.now().plus({ months: 1 }).toFormat('yyyy-LL-dd T'),
      times: ['Morning', 'Afternoon', 'Evenings', 'I am flexible'],
      days: [ 'During week days', 'During Weekends', 'I am flexible' ],
      timeSlot: null,
      daySlot: null,
      message: ''
    }
  },
  computed: {
    submitDisabled () {
      const dateSelected = this.daySlot === null
      const timeSelected = this.timeSlot === null
      const message = this.message === ''

      return dateSelected || timeSelected || message
    }
  },
  methods: {
    ...mapActions('ledge', ['request']),
    onDayClick (dayIndex) {
      this.daySlot = dayIndex
    },
    onTimeClick (timeIndex) {
      this.timeSlot = timeIndex
    },
    async onSendRequest () {
      const payload = {
        bookshelfItemId: this.selectedBook.id,
        pickup_date: this.today,
        pickup_day: this.days[ this.daySlot ],
        pickup_time: this.times[ this.timeSlot ],
        return_date: this.returnDate,
        message: this.message
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
  .items{
    @apply rounded-lg border-2 border-gray-500 mt-2 w-auto px-7 py-4 text-center font-bold;

    &.selected, &:hover{
      @apply bg-gray-500 text-white cursor-pointer;
    }
  }
  .textarea {
    @extend .items;
    width: 100%;
  }
  .button {
    position: absolute;
    bottom: 36px;
    right: 36px;
  }
}

</style>
