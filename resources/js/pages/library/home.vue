<template>
  <div>
    <button @click="search({latitude: 51.67139816, longitude: -4.00746388, radius: 3000})">
      Search with hardcoded location
    </button>
    <div v-for="(result, index) in searchedBooks" :key="index">
      <div class="card" style="width: 18rem;">
        <img :src="result.book.thumbnail" class="card-img-top" :alt="result.book.title">
        <div class="card-body">
          <h4 class="card-title">
            {{ result.book.title }}
          </h4>
          <h5 class="card-title">
            DIstance: {{ result.bookshelf.distance }}
          </h5>
          <p class="card-text short_text">
            {{ result.book.description }}
          </p>
          <button class="btn btn-primary" @click="goToLendPage(result.id)">
            Borrow book
          </button>
        </div>
      </div>
    </div>
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
    ...mapGetters('library', ['searchedBooks']),
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
