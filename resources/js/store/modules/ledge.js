import axios from 'axios'

// state
export const state = {
  items: []
}

// getters
export const getters = {
  items: state => state.items
}

// mutations
export const mutations = {
  SET_ITEMS (state, items) {
    state.items = items
  }
}

// actions
export const actions = {
  async getAll ({ commit }) {
    const { data } = await axios.get(`/api/ledge`)

    commit('SET_ITEMS', data)
  },
  async request ({ commit }, bookshelfItemId) {
    const { data } = await axios.post(`/api/ledge/request`, { bookshelfItemId })
    console.log(data)
  }
}
