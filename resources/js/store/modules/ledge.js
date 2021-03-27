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
  request: (state, getter, rootGetter) => state.items.filter(item => item.borrower_id === rootGetter.auth.user.id),
  ledge: (state, getter, rootGetter) => state.items.filter(item => item.lender_id === rootGetter.auth.user.id),
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
  async request ({ commit }, bookshelfItemId) {
    //sc88: Need to define date time from UI
    const date = DateTime.local(2021, 3, 27, 12).toFormat('yyyy-LL-dd TT')
  
    const { data } = await axios.post(`/api/ledge/request`, { bookshelfItemId, date })
    console.log(data)
  },
  async respond ({ commit }, { ledgeId, response }) {
    const { data } = await axios.post(`/api/ledge/request/respond`, { ledgeId, response })
    console.log(data)
  }
}
