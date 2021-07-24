import axios from 'axios'

// state
export const state = {
  searchResult: [],
  searchTitle: '',
  currentLocation: {
    lat: null,
    lon: null
  },
  conditions: [
    { id: 0, name: 'Very Good', description: 'Shows signs of wear. May have minor defects: clipped or chipped dust jacket; owner’s inscription; remainder mark; minor foxing or bumping. Used textbooks do not come with supplemental materials.' },
    { id: 1, name: 'Good', description: 'Average used book with all pages present. May have any of the defects above to a greater degree, including highlighting, library markings, or loose bindings. Rare and collectible books may have cocked spine, cracked hinges, water stains; torn or repaired dust jacket.' },
    { id: 2, name: 'Acceptable', description: 'May be very worn, soiled, torn, or barely holding together. Used textbooks do not come with supplemental materials.' },
    { id: 3, name: 'Poor', description: 'May have extensive damage from moisture or insects; detached boards; parts may be missing; marginally salable unless very unusual. Used textbooks do not come with supplemental materials.' }
  ],
  loading: false,
  categories: [],
  filter: {
    category: null,
    condition: null,
    transaction: null
  }
}

// getters
export const getters = {
  searchedBook: state => {
    let filteredResult = state.searchResult

    if (state.searchTitle) {
      filteredResult = filteredResult.filter(result => result.book.title.toLowerCase().includes(state.searchTitle.toLowerCase()))
    }

    if (state.filter.condition !== null) {
      filteredResult = filteredResult.filter(result => result.condition === state.filter.condition)
    }

    if (state.filter.transaction !== null) {
      filteredResult = filteredResult.filter(result => result.type === state.filter.transaction)
    }

    if (state.filter.category !== null) {
      filteredResult = filteredResult.filter(result => {
        return result.book.categories.find(category => category.id === state.filter.category)
      })
    }

    return filteredResult
  },
  otherBooks: state => {
    if (!state.searchTitle) return []

    return state.searchResult.filter(result => !result.book.title.toLowerCase().includes(state.searchTitle.toLowerCase()))
  },
  loading: state => state.loading
}

// mutations
export const mutations = {
  UPDATE_SEARCH_RESULT (state, result) {
    state.searchResult = result
  },
  RESET_SEARCH_RESULT (state) {
    state.searchResult = []
  },
  SET_SEARCH_TITLE (state, title) {
    state.searchTitle = title
  },
  SET_LOADING (state, value) {
    state.loading = value
  },
  SET_CATEGORIES (state, categories) {
    state.categories = categories
  },
  UPDATE_FILTER (state, payload) {
    state.filter[payload.filter] = payload.value !== null ? payload.value.id : null
  }
}

// actions
export const actions = {
  async search ({ commit, dispatch }, { searchTitle, latitude, longitude, radius }) {
    commit('SET_LOADING', true)
    commit('RESET_SEARCH_RESULT')
    const { data } = await axios.get(`/api/library/${latitude}/${longitude}/${radius}`)
    const filterCategories = (accumulator, value) => {
      return [...accumulator, ...value.book.categories]
    }
    const categories = data.reduce(filterCategories, [])
    commit('SET_CATEGORIES', [...new Map(categories.map(item => [item['name'], item])).values()])
    commit('SET_LOADING', false)
    if (!data) return
    if (searchTitle && searchTitle !== 'All') commit('SET_SEARCH_TITLE', searchTitle)
    commit('UPDATE_SEARCH_RESULT', data)
  },
  updateFilter ({ commit }, payload) {
    commit('UPDATE_FILTER', payload)
  }
}
