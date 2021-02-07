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
  bookshelf: []
}

// getters
export const getters = {
  searchedBooks: state => state.searchResult,
  bookshelf: state => state.bookshelf
}

// mutations
export const mutations = {
  UPDATE_SEARCH_RESULT (state, result) {
    state.searchResult = result
  },
  ADD (state, book) {
    state.bookshelf = [...state.bookshelf, book]
  }
}

// actions
export const actions = {
  async find ({ commit, dispatch }, { type, text }) {
    const { data } = await axios.get(`/api/bookshelf/${type}/${text}`)

    if (!data) return

    const books = data.map(createBookObject)

    commit('UPDATE_SEARCH_RESULT', books)
  },
  async add_book ({ commit, state }, { bookIndex, condition, status }) {
    const book = state.searchResult[bookIndex]
    await axios.post(`/api/bookshelf/store`, { ...book, condition, status })
    commit('ADD', book)
  },
  async fetchByBookshelfItemId ({ commit }, bookshelfItemId) {
    const { data } = await axios.get(`/api/bookshelf/bookshelf_item/${bookshelfItemId}`)

    return data
  }
}
