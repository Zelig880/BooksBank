import axios from 'axios'

const createBookObject = function (book) {
  if (!book.volumeInfo) return

  const ISBN = book.volumeInfo.industryIdentifiers[0].identifier
  const thumbnail = book.volumeInfo.imageLinks.thumbnail
  const description = book.volumeInfo.description
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
  bookshelf: [],
  items: []
}

// getters
export const getters = {
  searchedBook: state => state.searchResult,
  items: state => state.items
}

// mutations
export const mutations = {
  UPDATE_SEARCH_RESULT (state, result) {
    state.searchResult = result
  },
  ADD_ITEMS (state, book) {
    state.items = [...state.items, book]
  },
  SET_ITEMS (state, items) {
    state.items = items
  }
}

// actions
export const actions = {
  async find ({ commit, dispatch }, text) {
    const isbnRegex = /^(97(8|9))?\d{9}(\d|X)$/

    const type = text.match(isbnRegex) ? 'ISBN' : 'title'

    const { data } = await axios.get(`/api/bookshelf/${type}/${text}`)

    if (!data) return

    const books = data.map(createBookObject)

    commit('UPDATE_SEARCH_RESULT', books)
  },
  async add_book ({ commit, state }, selectedBook) {
    await axios.post(`/api/bookshelf/store`, { ...selectedBook, status: 0 })
    commit('ADD_ITEM', selectedBook)
  },
  async fetchByBookshelfItemId ({ commit }, bookshelfItemId) {
    const { data } = await axios.get(`/api/bookshelf/bookshelf_item/${bookshelfItemId}`)

    return data
  },
  async getAll ({ commit }) {
    const { data } = await axios.get(`/api/bookshelf`)

    commit('SET_ITEMS', data)
  }
}
