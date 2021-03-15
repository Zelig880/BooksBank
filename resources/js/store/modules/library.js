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
    'VeryGood',
    'Good',
    'Acceptable',
    'Poor'
  ]
}

// getters
export const getters = {
  searchedBook: state => {
    if (!state.searchTitle) return state.searchResult

    return state.searchResult.filter(result => result.book.title.toLowerCase().includes(state.searchTitle))
  },
  otherBooks: state => {
    if (!state.searchTitle) return []

    return state.searchResult.filter(result => !result.book.title.toLowerCase().includes(state.searchTitle))
  }
}

// mutations
export const mutations = {
  UPDATE_SEARCH_RESULT (state, result) {
    state.searchResult = result
  },
  SET_SEARCH_TITLE (state, title) {
    state.searchTitle = title
  }
}

// actions
export const actions = {
  async search ({ commit, dispatch }, { searchTitle, latitude, longitude, radius }) {
    const { data } = await axios.get(`/api/library/${latitude}/${longitude}/${radius}`)

    if (!data) return

    if (searchTitle && searchTitle !== 'All') commit('SET_SEARCH_TITLE', searchTitle)
    commit('UPDATE_SEARCH_RESULT', data)
  }
}
