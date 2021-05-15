<template>
  <div class="add-component container mx-auto flex">
    <div class="mr-8 hidden md:block add-component__image">
      <img v-if="thumbnail" :src="thumbnail" :alt="thumbnail_alt" />
    </div>
    <div class="add-form">
      <BookshelfAddNoBookshelfBanner v-if="!currentBookshelf"></BookshelfAddNoBookshelfBanner>
      <h2 class="mb-4 font-black text-gray-700 text-6xl font-lora">
        {{ $t('bookshelfAdd-title') }}
      </h2>
      <p class="text-lg">
        {{ $t('welcomeAdd-paragraph') }}
      </p>
      <BookshelfAddStep1 :disabled="currentStep !== 1 || !currentBookshelf" @select="selectBook" />
      <BookshelfAddStep2 v-if="currentStep >= 2" :disabled="currentStep !== 2" @select="selectCondition" />
      <Button v-if="currentStep === 3" class="float-right mt-6" @click="addToBookshelf">Add to your Bookshelf</Button>
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
      currentBookshelf: 'bookshelf/currentBookshelf'
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
  },
  methods: {
    ...mapActions('bookshelf', ['getCurrent', 'addBook']),
    async addToBookshelf () {
      const { success } = await this.addBook(this.selectedBook)
      if (success) {
        Swal.fire({
          type: 'success',
          title: 'Good Job!',
          text: 'Your book has been succesfully added to your Bookshelf!'
        }).then(() => {
          this.$router.push({ name: 'bookshelf.all' })
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
