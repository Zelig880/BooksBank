import axios from 'axios'

// state
export const state = {
  searchResult: [],
  currentLocation: {
    lat: null,
    lon: null
  }
}

// getters
export const getters = {
  searchedBooks: state => state.searchResult
}

// mutations
export const mutations = {
  UPDATE_SEARCH_RESULT (state, result) {
    state.searchResult = result
  }
}

// actions
export const actions = {
  async search ({ commit, dispatch }, { latitude, longitude, radius }) {
    const { data } = await axios.get(`/api/library/${latitude}/${longitude}/${radius}`)

    if (!data) return

    commit('UPDATE_SEARCH_RESULT', data)
  }
}
