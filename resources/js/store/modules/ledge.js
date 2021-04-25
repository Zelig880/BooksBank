import axios from 'axios'
import { DateTime } from 'luxon'

// state
export const state = {
  items: [],
  status: [
    'WaitingApproval',
    'WaitingPickup',
    'InProgress',
    'AwaitingReturn',
    'Completed',
    'Rejected'
  ]
}

// getters
export const getters = {
  borrowed: (state, getter, rootGetter) => state.items.filter(item => item.borrower_id === rootGetter.auth.user.id),
  lent: (state, getter, rootGetter) => state.items.filter(item => item.lender_id === rootGetter.auth.user.id),
  status: state => state.status
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
  async request ({ commit }, payload) {
    const { data } = await axios.post(`/api/ledge/request`, payload)
    console.log(data)
  },
  async respond ({ commit }, { ledgeId, response }) {
    const { data } = await axios.post(`/api/ledge/request/respond`, { ledgeId, response })
    console.log(data)
  }
}
