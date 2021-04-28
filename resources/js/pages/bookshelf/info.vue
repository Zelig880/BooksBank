<template>
  <div class="mt-14 mb-20 bookshelf-info">
    <div class="">
      <div class="">
        <div class="border-b">
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'Borrowed'}" @click="view = 'Borrowed'">
            Borrowed
          </button>
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'Loaned'}" @click="view = 'Loaned'">
            Loaned
          </button>
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'IncomingRequests'}" @click="view = 'IncomingRequests'">
            Incoming Requests
          </button>
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'OutgoingRequests'}" @click="view = 'OutgoingRequests'">
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
                  <td v-if="key !== 'id'" :key="`${row.id}-${key}`">{{ value }}</td>
                </template>
                <td v-if="view === 'Borrowed'">
                  <Button @click="returnBook(row)">Return</Button>
                </td>
                <td v-else-if="view === 'IncomingRequests' && row.status === 'WaitingApproval'">
                  <Button @click="handleResponse(row.id, 'accept')">Accept</Button>
                  <Button theme="secondary" @click="handleResponse(row.id, 'reject')">Reject</Button>
                </td>
                <td v-else>&nbsp;</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Swal from 'sweetalert2'

export default {
  name: 'Info',
  data () {
    return {
      view: 'Borrowed',
      tableHeading: {
        'Borrowed': ['Lender', 'Book', 'Condition'],
        'Loaned': ['Borrower', 'Book', 'Condition'],
        'IncomingRequests': ['User', 'Book', 'Condition', 'Proposed Collection', 'Time slot', 'status'],
        'OutgoingRequests': ['User', 'Book', 'Condition', 'Proposed Collection', 'Time slot', 'status']
      }
    }
  },
  computed: {
    ...mapGetters('ledge', ['borrowed', 'lent', 'incomingRequests', 'outgoingRequests']),
    title () {
      let value
      switch (this.view) {
        case 'Borrowed':
          value = 'Borrowed book'
          break
        case 'Loaned':
          value = 'Your book on loan'
          break
        case 'IncomingRequests':
          value = 'Incoming requests'
          break
        case 'OutgoingRequests':
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
        case 'Borrowed':
          value = this.borrowed
          break
        case 'Loaned':
          value = this.lent
          break
        case 'OutgoingRequests':
          value = this.outgoingRequests
          break
        case 'IncomingRequests':
          value = this.incomingRequests
          break
      }

      return value
    }
  },
  mounted () {
    this.getAll()
  },
  methods: {
    ...mapActions({
      getAll: 'ledge/getAll',
      respond: 'ledge/respond'
    }),
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
