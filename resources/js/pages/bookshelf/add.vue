<template>
  <div>
    <h2 class="mb-4 text-center font-black text-gray-700 text-2xl">
      {{ $t('bookshelfAdd-title') }}
    </h2>
    <p class="text-lg">
      {{ $t('welcomeAdd-paragraph') }}
    </p>
    <BookshelfAddSteps :current-step="currentStep" />
    <BookshelfAddStep1 v-if="currentStep === 1" @select="selectBook" />
    <BookshelfAddStep2 v-if="currentStep === 2" @select="selectCondition" />
    <BookshelfAddStep3 v-if="currentStep === 3" v-bind="selectedBook" @select="confirm" />
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import BookshelfAddStep1 from '../../components/sections/bookshelfAddStep1.vue'
import BookshelfAddStep2 from '../../components/sections/bookshelfAddStep2.vue'
import BookshelfAddStep3 from '../../components/sections/bookshelfAddStep3.vue'
import BookshelfAddSteps from '../../components/sections/bookshelfAddSteps.vue'

export default {
  name: 'Add',
  components: {
    BookshelfAddSteps,
    BookshelfAddStep1,
    BookshelfAddStep2,
    BookshelfAddStep3
  },
  data () {
    return {
      selectedBook: null,
      currentStep: 1
    }
  },
  methods: {
    ...mapActions({
      addBook: 'bookshelf/add_book'
    }),
    async addToBookshelf () {
      await this.addBook(this.selectedBook)
      this.showLend = true
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
.short_text{
  overflow: hidden;
  white-space: nowrap;
  -o-text-overflow: ellipsis;
  -ms-text-overflow: ellipsis;
  text-overflow: ellipsis;
  width: auto;
}
</style>
