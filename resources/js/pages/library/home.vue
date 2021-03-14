<template>
  <div>
    <h2>My Borrow request</h2>
    <div>
      <table>
        <tr>
          <th>Book name</th>
          <th>Length time</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <tr v-for="(result, index) in request" :key="`br-${index}`">
          <td>{{ result.book.title }}</td>
          <td>{{ result.lend_duration }}</td>
          <td>{{ status[result.status] }}</td>
          <td>Action</td>
        </tr>
      </table>
    </div>
    <h2>Lending board</h2>
    <div>
      <table>
        <tr>
          <th>Book name</th>
          <th>Length time</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <tr v-for="(result, index) in ledge" :key="`ld-${index}`">
          <td>{{ result.book.title }}</td>
          <td>{{ result.lend_duration }}</td>
          <td>{{ status[result.status] }}</td>
          <td>
            <button @click="respond({ledgeId: result.id, response:'accept'})">
              Accept
            </button>
            <button @click="respond({ledgeId: result.id, response:'reject'})">
              Reject
            </button>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  scrollToTop: true,
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('library') }
  },

  data: () => ({
  }),
  computed: {
    ...mapGetters('library', ['searchedBook']),
    ...mapGetters('ledge', ['request', 'status', 'ledge'])
  },
  mounted () {
    this.getAll()
  },
  methods: {
    ...mapActions('library', ['search']),
    ...mapActions('ledge', ['getAll', 'respond']),
    goToLendPage (bookshelfItemId) {
      this.$router.push({ name: 'library.borrow', params: { bookshelfItemId } })
    }
  }
}
</script>
