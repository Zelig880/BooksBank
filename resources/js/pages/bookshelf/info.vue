<template>
  <div class="mt-14 mb-20 bookshelf-info">
    <div class="">
      <div class="">
        <div class="border-b">
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'borrowed'}" @click="handleRoute('borrowed')">
            Borrowed
          </button>
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'loaned'}" @click="handleRoute('loaned')">
            Loaned
          </button>
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'incoming'}" @click="handleRoute('incoming')">
            Incoming Requests
          </button>
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'outgoing'}" @click="handleRoute('outgoing')">
            Outgoing Requests
          </button>
        </div>
        <div>
          <h3>{{ title }}</h3>
          <table>
            <thead>
              <tr>
                <th v-for="header in headers" :key="header">{{ header }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="row in rows" :key="row.id">
                <template v-for="(value, key) in row">
                  <td v-if="key !== 'id' && !key.includes('_id')" :key="`${row.id}-${key}`">{{ value }}</td>
                </template>
                <td v-if="view === 'borrowed'">
                  <Button @click="handleReturnRequest(row)">Return</Button>
                </td>
                <td v-else-if="view === 'incoming'">
                  <template v-if="row.status === 'WaitingApproval'">
                    <Button @click="handleResponse(row.id, 'accept')">Accept</Button>
                    <Button theme="secondary" @click="handleResponse(row.id, 'reject')">Reject</Button>
                  </template>
                  <template v-if="row.status === 'ReturnRequested'">
                    <Button @click="handleReturnResponse(row.id, 'accept')">Accept</Button>
                    <Button theme="secondary" @click="handleReturnResponse(row.id, 'reject')">Reject</Button>
                  </template>
                  <template v-if="row.status === 'WaitingPickup'">
                    <Button @click="handleCollection(row.id)">Collected</Button>
                  </template>
                  <template v-if="row.status === 'AwaitingReturn'">
                    <Button @click="handleReturned(row.id)">Returned</Button>
                  </template>
                </td>
                <td v-else>&nbsp;</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <ReturnModal :show="showModal" :selected-book="selectedBook" @close="closeModal" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import ReturnModal from '../../components/sections/returnModal'
import Swal from 'sweetalert2'

export default {
  name: 'Info',
  components: {
    ReturnModal
  },
  data () {
    return {
      view: 'borrowed',
      tableHeading: {
        'borrowed': ['Lender', 'Book', 'Condition', 'status'],
        'loaned': ['Borrower', 'Book', 'Condition', 'status'],
        'incoming': ['User', 'Book', 'Condition', 'Proposed Collection', 'Time slot', 'status'],
        'outgoing': ['User', 'Book', 'Condition', 'Proposed Collection', 'Time slot', 'status']
      },
      showModal: false,
      selectedBook: null
    }
  },
  computed: {
    ...mapGetters('ledge', ['borrowed', 'lent', 'incomingRequests', 'outgoingRequests', 'getItemByLedgeId']),
    title () {
      let value
      switch (this.view) {
        case 'borrowed':
          value = 'Borrowed book'
          break
        case 'loaned':
          value = 'Your book on loan'
          break
        case 'incoming':
          value = 'Incoming requests'
          break
        case 'outgoing':
          value = 'Outgoing requests'
          break
      }

      return value
    },
    headers () {
      return this.tableHeading[this.view]
    },
    rows () {
      let value
      switch (this.view) {
        case 'borrowed':
          value = this.borrowed
          break
        case 'loaned':
          value = this.lent
          break
        case 'outgoing':
          value = this.outgoingRequests
          break
        case 'incoming':
          value = this.incomingRequests
          break
      }

      return value
    }
  },
  mounted () {
    const pathArray = this.$route.path.split('/')
    const view = pathArray[pathArray.length - 1]
    // we make sure that we have not landed on the generic endpoint
    if (view !== 'info') {
      // if the view is set, we update it.
      this.view = view
    }
    this.getAll()
  },
  methods: {
    ...mapActions({
      getAll: 'ledge/getAll',
      respond: 'ledge/respond',
      collect: 'ledge/collect',
      returnRespond: 'ledge/returnRespond',
      returned: 'ledge/returned'
    }),
    ...mapActions('bookshelf', ['fetchByBookshelfItemId']),
    handleRoute (view) {
      this.view = view
      this.$router.push(`/bookshelf/info/${view}`)
    },
    async handleReturnRequest (book) {
      const data = await this.fetchByBookshelfItemId(book.bookshelf_item_id)
      if (!data.success) return

      // we add the ledgeId to the returned object
      data.result.ledgeId = book.id
      this.selectedBook = data.result
      this.showModal = true
    },
    async handleResponse (ledgeId, response) {
      try {
        await this.respond({ ledgeId, response })
        let message = {}

        switch (response) {
          case 'accept':
            message.title = 'Request Accepted'
            message.text = 'Thank you for accepting the request! The book will be picked up as planned!'
            break
          default:
            message.title = 'Request Rejected'
            message.text = 'We are sorry to hear that. If the time did not suit you, make sure to keep your bookshelf opening time updated.'
            break
        }
        Swal.fire({
          type: 'success',
          title: message.title,
          text: message.text
        }).then(() => {
          this.getAll()
        })
      } catch (error) {
        Swal.fire({
          type: 'error',
          title: 'Server error',
          text: 'The request was not sent. Please try again later, and contact your administrator if the issue persist.'
        })
      }
    },
    async handleReturnResponse (ledgeId, response) {
      try {
        await this.returnRespond({ ledgeId, response })
        let message = {}

        switch (response) {
          case 'accept':
            message.title = 'Return request accepted'
            message.text = 'Thank you for accepting the request! The book will be returned up as planned!'
            break
          default:
            message.title = 'Return request rejected'
            message.text = 'We are sorry to hear that. If the time did not suit you, make sure to keep your bookshelf opening time updated.'
            break
        }
        Swal.fire({
          type: 'success',
          title: message.title,
          text: message.text
        }).then(() => {
          this.getAll()
        })
      } catch (error) {
        Swal.fire({
          type: 'error',
          title: 'Server error',
          text: 'The request was not sent. Please try again later, and contact your administrator if the issue persist.'
        })
      }
    },
    async handleReturned (ledgeId) {
      try {
        await this.returned({ ledgeId })
        let message = {}

        message.title = 'Book return recorded'
        message.text = 'Thank you for updating the book status.'

        Swal.fire({
          type: 'success',
          title: message.title,
          text: message.text
        }).then(() => {
          this.getAll()
        })
      } catch (error) {
        Swal.fire({
          type: 'error',
          title: 'Server error',
          text: 'The request was not sent. Please try again later, and contact your administrator if the issue persist.'
        })
      }
    },
    async handleCollection (ledgeId) {
      try {
        await this.collect({ ledgeId })
        let message = {}

        message.title = 'Collection recorded'
        message.text = 'Thank you for updating the book status.'

        Swal.fire({
          type: 'success',
          title: message.title,
          text: message.text
        }).then(() => {
          this.getAll()
        })
      } catch (error) {
        Swal.fire({
          type: 'error',
          title: 'Server error',
          text: 'The request was not sent. Please try again later, and contact your administrator if the issue persist.'
        })
      }
    },
    closeModal () {
      this.showModal = false
    }
  }
}
</script>

<style lang="scss">
.bookshelf-info {
  h3 {
    font-family: OpenSans;
    font-size: 24px;
    font-weight: 600;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.5;
    letter-spacing: -0.49px;
    color: var(--sub-text);
    margin-bottom: 30px;
    margin-top: 36px;
  }
  table {
    width: 100%;
    th {
      opacity: 0.9;
      font-family: OpenSans;
      font-size: 14px;
      font-weight: bold;
      font-stretch: normal;
      font-style: normal;
      line-height: 1.35;
      color: var(--sub-text);
      text-align: left;
    }
    thead, tr {
      border-bottom: solid 1px rgba(44, 53, 68, 0.43);
    }
    td, th {
      padding: 21px 0px 12px 0px;
    }
    td:nth-child(1){
      opacity: 0.71;
      font-family: OpenSans;
      font-size: 14px;
      font-weight: 600;
      font-stretch: normal;
      font-style: normal;
      line-height: 1.5;
      letter-spacing: normal;
      color: var(--link);
    }
    td:nth-child(2) {
      font-family: OpenSans;
      font-size: 16px;
      font-weight: normal;
      font-stretch: normal;
      font-style: normal;
      line-height: 1.69;
      letter-spacing: normal;
      color: var(--link);
    }
    tbody{
      font-family: OpenSans;
      font-size: 16px;
      font-weight: normal;
      font-stretch: normal;
      font-style: normal;
      line-height: 1.69;
      letter-spacing: normal;
      color: var(--body-dark);
    }
  }
  &__header-button {
    margin: 0 35px 0px 0;
    padding-bottom: 7px;
    font-family: OpenSans;
    font-size: 16px;
    font-weight: 600;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.31;
    letter-spacing: normal;
    color: var(--link);
    &--selected{
      color: var(--header);
      border-bottom-width: 4px;
      border-color: var(--body-dark);
    }
  }
}
</style>
