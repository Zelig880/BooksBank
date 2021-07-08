<template>
  <div v-if="selectedBook" class="container py-12 mx-auto grid grid-cols-1 md:grid-cols-6">
    <img class="mx-auto md:w-9/12 " :src="selectedBook.book.thumbnail" :alt="selectedBook.book.title">
    <div class="col-span-4">
      <div class="mx-4 mt-4 sm:mx-auto">
        <h2 class="text-3xl font-bold">
          {{ selectedBook.book.title }}
        </h2>
        <h2 v-if="authors" class="text-xl text-gray-500 mb-4">
          By {{ authors }}
        </h2>
        <p class="font-semibold" v-html="showFullDescription ? formattedDescription : shortDescription" />
        <button v-if="descriptionNeedShortening" class="cursor-pointer underline font-bold" @click="showFullDescription = !showFullDescription">
          {{ showFullDescription ? 'show less' : 'show more' }}
        </button>
        <p class="text-xl mt-4 text-gray-500 mb-4">
          Book owner: <span class="font-semibold">{{ selectedBook.bookshelf.user.name }}</span>
        </p>
        <p class="text-xl mt-4 text-gray-500 mb-4">
          Book location: <span class="font-semibold">{{ selectedBook.bookshelf.city || selectedBook.bookshelf.postcode }}</span>
        </p>
        <hr>
        <BorrowModal :show="showModal" :selected-book="selectedBook" @close="closeModal" />
        <Button class="mt-3" @click="showModal = true">
          Borrow book
        </Button>
      </div>
    </div>
    <div class="col-span-2"></div>
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
      showModal: false
    }
  },
  computed: {
    authors () {
      const authorsArray = this.selectedBook.book.authors
      const authorsNames = authorsArray.map(author => author['name'])

      return authorsNames.join(',')
    },
    descriptionNeedShortening () {
      if (this.formattedDescription.length >= 256) return true

      return false
    },
    shortDescription () {
      if (!this.descriptionNeedShortening) return this.formattedDescription

      return `${this.formattedDescription.substring(0, 256)}...`
    },
    formattedDescription () {
      return this.selectedBook.book.description.replace(/\.\s/g, '.<br>')
    }
  },
  async mounted () {
    const data = await this.fetchByBookshelfItemId(this.$route.params.bookshelfItemId)
    if (data.success) this.selectedBook = data.result
  },
  methods: {
    ...mapActions('bookshelf', ['fetchByBookshelfItemId']),
    closeModal () {
      this.showModal = false
    }
  }
}
</script>

<style>

</style>