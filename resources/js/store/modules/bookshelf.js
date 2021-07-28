import axios from 'axios'
import Swal from 'sweetalert2'

const createBookObject = function (book) {
  if (!book.volumeInfo) return

  const ISBN = book.volumeInfo.industryIdentifiers ? book.volumeInfo.industryIdentifiers[0].identifier : 'N/A'
  const thumbnail = book.volumeInfo.imageLinks ? book.volumeInfo.imageLinks.thumbnail : '/assets/img/default_cover.png'
  const description = book.volumeInfo.description || ''
  const categories = book.volumeInfo.categories
  const authors = book.volumeInfo.authors
  const title = book.volumeInfo.title

  return {
    title,
    description,
    ISBN,
    thumbnail,
    categories,
    authors
  }
}

// state
export const state = {
  searchResult: [],
  currentBookshelf: null,
  items: [],
  transactionType: [
    { id: 0, name: 'Temporary Loan', nameForCustomer: 'Borrow' },
    { id: 1, name: 'Give Away', nameForCustomer: 'Get for Free' }
  ]
}

// getters
export const getters = {
  searchedBook: state => state.searchResult,
  items: state => state.items,
  currentBookshelf: state => state.currentBookshelf
}

// mutations
export const mutations = {
  UPDATE_SEARCH_RESULT (state, result) {
    state.searchResult = result
  },
  SET_ITEMS (state, items) {
    state.items = items
  },
  RESET_SEARCH_RESULT (state) {
    state.searchResult = []
  },
  REMOVE_ITEM (state, id) {
    const index = state.items.findIndex(item => item.id === id)
    state.items.splice(index, 1)
  },
  SET_CURRENT_BOOKSHELF (state, bookshelf) {
    state.currentBookshelf = bookshelf
  }
}

// actions
export const actions = {
  async find ({ commit, dispatch }, text) {
    const isbnRegex = /^(97(8|9))?\d{9}(\d|X)$/

    const type = text.match(isbnRegex) ? 'ISBN' : 'title'

    const { data } = await axios.get(`/api/bookshelf/${type}/${text}`)
    if (!data || data.length === 0) {
      Swal.fire({
        type: 'error',
        title: 'Your book could not be found',
        text: 'Unfortunately, your book could not be found. If you used the ISBN, try to use the title instead.'
      })
      return
    }

    const books = data.map(createBookObject)

    commit('UPDATE_SEARCH_RESULT', books)
  },
  async addBook ({ commit, state }, selectedBook) {
    const { data } = await axios.post(`/api/bookshelf_item/store`, { ...selectedBook, status: 0 })
    commit('SET_ITEMS', data.result)

    return data
  },
  async fetchByBookshelfItemId ({ commit }, bookshelfItemId) {
    const { data } = await axios.get(`/api/bookshelf_item/${bookshelfItemId}`)

    return data
  },
  async getAll ({ commit }) {
    const { data } = await axios.get(`/api/bookshelf_item`)

    commit('SET_ITEMS', data)
  },
  async getCurrent ({ commit }) {
    const { data } = await axios.get('/api/bookshelf')

    if (Object.keys(data).length === 0) return
    commit('SET_CURRENT_BOOKSHELF', data)
  },
  reset ({ commit }) {
    commit('RESET_SEARCH_RESULT')
  },
  async updateOrCreate ({ dispatch, state }, payload) {
    if (state.currentBookshelf?.id) {
      const { data } = await axios.put(`/api/bookshelf/${state.currentBookshelf.id}/update`, payload)
      return data
    } else {
      const { data } = await axios.post(`/api/bookshelf/create`, payload)
      dispatch('getCurrent')
      return data
    }
  },
  async delete ({ commit }, bookshelfItemId) {
    const { data } = await axios.delete(`/api/bookshelf_item/delete/${bookshelfItemId}`)
    if (data.success) {
      commit('REMOVE_ITEM', bookshelfItemId)
      Swal.fire({
        type: 'success',
        title: 'Your book was succesfully removed',
        text: 'Your book was succesfully removed from your bookshelf.'
      })
    } else {
      Swal.fire({
        type: 'error',
        title: 'Your book could not be remove',
        text: 'There was an error with your request, and your book could not be removed from your bookshelf.'
      })
    }
  }
}
