<template>
  <div id="about" class="container mx-auto">
    <h2 class="text-3xl font-bold mb-6">
      F.A.Q.
    </h2>
    <p>
      Welcome to the Frequently asked question section. In this page you are going to find all the information necessary to understand how BooksBank works.
      If the question you are asking is not available here, please feel free to contact us on <a href="mailto:info@booksbank.co.uk" target="_blank">info@booksbank.co.uk</a>
    </p>
    <VueFaqAccordion
      :items="myItems"
      :active-color="activeColor"
      :border-color="borderColor"
    />
  </div>
</template>

<script>
import VueFaqAccordion from 'vue-faq-accordion'

export default {
  metaInfo () {
    return { title: this.$t('faq') }
  },
  components: {
    VueFaqAccordion
  },
  data () {
    return {
      myItems: [
        {
          title: 'How much does it cost to borrow/acquire a book',
          value: 'Borrowing or Getting a book from other owners is totally free. BooksBank is just a platform to get both parties together.',
          category: 'General Questions'
        },
        {
          title: 'I have some technical issues, what shall I do',
          value: 'Send an email to info@booksbank.co.uk, and someone will get back to you as soon as possible.',
          category: 'General Questions'
        },
        {
          title: 'Is there a limit on books that I can borrow/lend',
          value: 'Currently the system does not have any limit on books that can be borrowed, but we are working on features that will prevent users from overusing the system.',
          category: 'General Questions'
        },
        {
          title: 'How do you guarantee that the books is returned',
          value: 'This is one of the most common questions for new lenders. First and foremost we alway ask people to make sure that the book that are lend are not super valuable as things could always happen. Secondly, we have been built this patform with the community in place and we have so far been amazed by the great support and consistency of our users. Said that, it is important that lending a book is at the owner own risk and booksbank cannot assume any responsibility in it.',
          category: 'General Questions'
        },
        {
          title: 'The book as not been returned what shall I do?',
          value: 'Send us an email to info@booksbank.co.uk with your email address and the book that has not been returned, and we will try to get in touch with the borrower.',
          category: 'General Questions'
        },
        {
          title: 'Do I need to have pictures of the book to add it?',
          value: 'The website will automatically fetch a book cover from one of the largest database of books in the world, and does not require you to add any specific information.',
          category: 'General Questions'
        },
        {
          title: 'How will I know if a book request has been received?',
          value: 'When a book request is received, you will receive an email to the registered email address with all information about the request and a link to answer.',
          category: 'General Questions'
        },
        {
          title: 'How do I Borrow a book?',
          value: 'Fill up the form available on the homepage of the site and search for books nearby. When you find the correct book, click Borrow and follow the form provided. You will receive an email with a response to your book request. In case of an approved request, the email will include full details on how to pick the book up.',
          category: 'Guides'
        },
        {
          title: 'How do I add a book?',
          value: 'To add a book, login into your account and click on the "add a book" button on top of the navigation bar. If this is the first book, you may be required to complete the bookshelf registration. After this is completed adding a book is very simple, you just need to follow the few steps shown on screen, no pictures required.',
          category: 'Guides'
        },
        {
          title: 'How do I remove a book?',
          value: 'If the book is not longer available, you can easily remove it from your bookshelf. To do so, click the book icon on the main navigation or bo to "http://booksbank.co.uk/bookshelf/all". In this page you will be able to delete a book by clicking the "Delete" button',
          category: 'Guides'
        }
      ],
      activeColor: '#755998',
      borderColor: '#9188b9'
    }
  }
}
</script>
<style lang="scss">
.faq{
  .faq-wrapper{
    max-width:100% !important;
  }
}
</style>
