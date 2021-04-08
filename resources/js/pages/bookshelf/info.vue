<template>
  <div class="mt-14 bookshelf-info">
    <div class="">
      <div class="">
        <div class="border-b">
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'Borrowed'}" @click="view = 'Borrowed'">
            Borrowed
          </button>
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'Loaned'}" @click="view = 'Loaned'">
            Loaned
          </button>
          <button class="bookshelf-info__header-button" :class="{ 'bookshelf-info__header-button--selected': view === 'Requests'}" @click="view = 'Requests'">
            Requests
          </button>
        </div>
        <div>
          <h3>{{ title }}</h3>
          <table>
            <thead>
              <th>ciao</th>
              <th>ciao</th>
              <th>ciao</th>
            </thead>
            <tbody>
              <tr>
                <td>Ciao</td>
                <td>Ciao</td>
                <td>Ciao</td>
              </tr>
              <tr>
                <td>Ciao</td>
                <td>Ciao</td>
                <td>Ciao</td>
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

export default {
  name: 'Info',
  data () {
    return {
      view: 'Borrowed'
    }
  },
  computed: {
    ...mapGetters('ledge', ['borrowed', 'lent']),
    title () {
      let value
      switch (this.view) {
        case 'Borrowed':
          value = 'Borrowed book'
          break
        case 'Loaned':
          value = 'Your book on loan'
          break
        case 'Requests':
          value = 'Open requests'
      }

      return value
    }
  },
  mounted () {
    this.getAll()
  },
  methods: {
    ...mapActions({
      getAll: 'ledge/getAll'
    })
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
