<template>
  <div v-if="selectedBook" class="container py-12 mx-auto grid grid-cols-6">
    <img class="w-9/12" :src="selectedBook.book.thumbnail" :alt="selectedBook.book.title">
    <div class="col-span-3">
      <div class="">
        <h2 class="text-3xl font-bold">
          {{ selectedBook.book.title }}
        </h2>
        <h2 v-if="authors" class="text-xl text-gray-500 mb-4">
          By {{ authors }}
        </h2>
        <p class="font-semibold">
          {{ showFullDescription ? selectedBook.book.description : shortDescription }}
          <a class="cursor-pointer underline font-bold" @click="showFullDescription = !showFullDescription"> 
            {{ showFullDescription ? 'show less' : 'show more' }}
          </a>
        </p>
        <hr>
        <BorrowTimeSlot :title="$t('libraryBorrow-timeslot-title')" :available-slots="availableTimeslot" @select="setPickups" />
        <BorrowModal :show="showModal" @close="closeModal" />
        <button class="btn btn-primary" @click="request(selectedBook.id)">
          Borrow book
        </button>
      </div>
    </div>
    <div class="col-span-2">
      sidebar
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import BorrowModal from '../../components/sections/borrowModal'

export default {
  middleware: 'auth',
  components: {
    BorrowModal
  },
  data () {
    return {
      selectedBook: null,
      showFullDescription: false,
      selectedPickups: [],
      showModal: true
    }
  },
  computed: {
    authors () {
      const authorsArray = this.selectedBook.book.authors
      const authorsNames = authorsArray.map(author => author['name'])

      return authorsNames.join(',')
    },
    shortDescription () {
      const fullDescription = this.selectedBook.book.description

      if (fullDescription.length <= 256) return fullDescription

      return `${fullDescription.substring(0, 256)}...`
    },
    availableTimeslot () {
      if (!this.selectedBook.bookshelf.pickup_times) return []

      return JSON.parse(this.selectedBook.bookshelf.pickup_times)
    }
  },
  async mounted () {
    const data = await this.fetchByBookshelfItemId(this.$route.params.bookshelfItemId)
    if (data.success) this.selectedBook = data.result
  },
  methods: {
    ...mapActions('bookshelf', ['fetchByBookshelfItemId']),
    ...mapActions('ledge', ['request']),
    setPickups (slots) {
      this.selectedPickups = slots
    },
    closeModal () {
      debugger;
      this.showModal = false
    }
  }
}
</script>

<style>

</style>