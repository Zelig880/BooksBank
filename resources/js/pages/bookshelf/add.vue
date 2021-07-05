<template>
  <div class="add-component container mx-auto flex">
    <div class="mr-8 hidden md:block add-component__image">
      <img v-if="thumbnail" :src="thumbnail" :alt="thumbnail_alt">
    </div>
    <div class="add-form">
      <BookshelfAddNoBookshelfBanner v-if="!currentBookshelf" />
      <h2 class="mb-4 font-black text-gray-700 text-6xl font-lora">
        {{ $t('bookshelfAdd-title') }}
      </h2>
      <p class="text-lg">
        {{ $t('welcomeAdd-paragraph') }}
      </p>
      <BookshelfAddStep1 ref="bookSelection" :disabled="currentStep !== 1 || !currentBookshelf" @select="selectBook" />
      <BookshelfAddStep2 v-if="currentStep === 2 || currentStep === 3" @select="selectCondition" />
      <Button v-if="currentStep === 3" class="float-right mt-6 ml-6" @click="addToBookshelf">
        Add to your Bookshelf
      </Button>
      <Button v-if="selectedBook && currentStep !== 4" theme="secondary" color="secondary" class="float-right mt-6" @click="resetSelection">
        Start again
      </Button>
      <Button v-if="currentStep === 4" theme="cta" color="secondary" class="float-right mt-6 ml-6" @click="resetSelection">
        Add another book
      </Button>
      <Button v-if="currentStep === 4" theme="cta" color="secondary" class="float-right mt-6 ml-6" @click="routetolib">
        My Library
      </Button>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import BookshelfAddNoBookshelfBanner from '../../components/sections/bookshelfAddNoBookshelfBanner.vue'
import BookshelfAddStep1 from '../../components/sections/bookshelfAddStep1.vue'
import BookshelfAddStep2 from '../../components/sections/bookshelfAddStep2.vue'
import Swal from 'sweetalert2'

export default {
  name: 'Add',
  middleware: 'auth',
  components: {
    BookshelfAddStep1,
    BookshelfAddStep2,
    BookshelfAddNoBookshelfBanner
  },
  data () {
    return {
      selectedBook: null,
      currentStep: 1
    }
  },
  computed: {
    ...mapGetters({
      currentBookshelf: 'bookshelf/currentBookshelf',
      bookshelf_items: 'bookshelf/items'
    }),
    thumbnail () {
      return this.selectedBook ? this.selectedBook.thumbnail : false
    },
    thumbnail_alt () {
      return this.selectedBook ? `cover for ${this.selectedBook.title}` : 'Empty book cover'
    }
  },
  mounted () {
    this.getCurrent()
    this.getAll()
  },
  methods: {
    ...mapActions(
      'bookshelf', ['getCurrent', 'addBook', 'getAll']),
    async addToBookshelf () {
      const { success } = await this.addBook(this.selectedBook)
      if (success) {
        Swal.fire({
          type: 'success',
          title: 'Good Job!',
          text: 'Your book has been succesfully added to your Bookshelf!'
        }).then(() => {
          this.currentStep = 4
        })
      } else {
        Swal.fire({
          type: 'error',
          title: 'Ops, you book fell!',
          text: 'There was an error in processing your request.'
        })
      }
    },
    selectBook (book) {
      // Check if book is already present on the user bookshelf
      const bookAlreadyInBookshelf = this.bookshelf_items.some(bookshelfItem => bookshelfItem.book.title === book.title, book)
      if (bookAlreadyInBookshelf) {
        Swal.fire({
          type: 'error',
          title: 'The book already exist',
          text: 'The book you selected is already part of your bookshelf. Booksbank does not currently allow to add multiple copies of the same book.'
        })
        this.resetSelection()
      } else {
        this.selectedBook = book
        this.currentStep = 2
      }
    },
    selectCondition (condition) {
      this.$set(this.selectedBook, 'condition', condition)
      this.currentStep = 3
    },
    confirm (value) {
      if (value === 'Reject') {
        this.selectedBook = {}
        this.currentStep = 1
      } else {
        this.addBook(this.selectedBook)
      }
    },
    routetolib () {
      this.$router.push({ name: 'bookshelf.all' })
    },
    resetSelection () {
      this.currentStep = 1
      this.selectedBook = null
      if (this.$refs.bookSelection && this.$refs.bookSelection.resetSearch) {
        this.$refs.bookSelection.resetSearch()
      }
    }
  }
}
</script>

<style lang="scss">
.add-component{
  &__image{
    width: 175px;
    height: 264px;
    background-color: var(--img-holder);
    img{
      height:100%;
      width: 100%;
    }
  }
  .add-form{
    max-width: 624px;
    width:100%;
    min-height:600px;
  }
}

</style>
