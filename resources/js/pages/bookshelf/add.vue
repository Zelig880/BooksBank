<template>
  <div class="container mx-auto flex">
    <div class="mr-8 hidden md:block">
      <img :src="thumbnail" :alt="thumbnail_alt" class="w-full h-auto" />
    </div>
    <div class="add-form">
      <h2 class="mb-4 font-black text-gray-700 text-6xl font-lora">
        {{ $t('bookshelfAdd-title') }}
      </h2>
      <p class="text-lg">
        {{ $t('welcomeAdd-paragraph') }}
      </p>
      <BookshelfAddStep1 :disabled="currentStep !== 1" @select="selectBook" />
      <BookshelfAddStep2 v-if="currentStep >= 2" :disabled="currentStep !== 2" @select="selectCondition" />
      <Button v-if="currentStep === 3" class="float-right mt-6" @click="addToBookshelf">Add to your Bookshelf</Button>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import BookshelfAddStep1 from '../../components/sections/bookshelfAddStep1.vue'
import BookshelfAddStep2 from '../../components/sections/bookshelfAddStep2.vue'
import Swal from 'sweetalert2'

export default {
  name: 'Add',
  components: {
    BookshelfAddStep1,
    BookshelfAddStep2
  },
  data () {
    return {
      selectedBook: null,
      currentStep: 1
    }
  },
  computed: {
    thumbnail () {
      return this.selectedBook ? this.selectedBook.thumbnail : '/assets/img/default_cover.png'
    },
    thumbnail_alt () {
      return this.selectedBook ? `cover for ${this.selectedBook.title}` : 'Empty book cover'
    }

  },
  methods: {
    ...mapActions({
      addBook: 'bookshelf/add_book'
    }),
    async addToBookshelf () {
      await this.addBook(this.selectedBook)
      Swal.fire({
        type: 'success',
        title: 'Good Job!',
        text: 'Your book has been succesfully added to your Bookshelf!'
      }).then(() => {
        this.$router.push({ name: 'bookshelf.all' })
      })
    },
    selectBook (book) {
      this.selectedBook = book
      this.currentStep = 2
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
    }
  }
}
</script>

<style>
.add-form{
  max-width: 624px;
  width:100%;
}
</style>
