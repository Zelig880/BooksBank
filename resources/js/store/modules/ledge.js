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
  borrowed: (state, getter, rootGetter) => {
    let items = []
    state.items.forEach(item => {
      if (item.borrower_id !== rootGetter.auth.user.id || item.status !== 2) return
      const conditionIndex = item.book.bookshelf_item.find(bookshelfItem => bookshelfItem.id === item.bookshelf_item_id).condition
      const value = {
        borrower: item.borrower.name,
        book: item.book.title,
        condition: rootGetter.library.conditions[conditionIndex].name,
        return_date: item.return_date
      }
      items.push(value)
    })

    return items
  },
  lent: (state, getter, rootGetter) => {
    let items = []
    state.items.forEach(item => {
      if (item.lender_id !== rootGetter.auth.user.id || item.status !== 2) return
      const conditionIndex = item.book.bookshelf_item.find(bookshelfItem => bookshelfItem.id === item.bookshelf_item_id).condition
      const value = {
        borrower: item.borrower.name,
        book: item.book.title,
        condition: rootGetter.library.conditions[conditionIndex].name,
        return_date: item.return_date
      }
      items.push(value)
    })

    return items
  },
  incomingRequests: (state, getter, rootGetter) => {
    let items = []
    state.items.forEach(item => {
      if (item.status >= 2 || item.borrower_id !== rootGetter.auth.user.id) return
      const conditionIndex = item.book.bookshelf_item.find(bookshelfItem => bookshelfItem.id === item.bookshelf_item_id).condition
      const pickDateTime = DateTime.fromSQL(item.pickup_date)
      const proposedCollection = pickDateTime.toFormat('cccc, d LLLL')
      const timeSlot = pickDateTime.toFormat('t') + ' - ' + pickDateTime.plus({ hours: 2 }).toFormat('t')
      const value = {
        id: item.id,
        lender: item.lender.name,
        book: item.book.title,
        condition: rootGetter.library.conditions[conditionIndex].name,
        proposed_collection: proposedCollection,
        time_slot: timeSlot,
        status: state.status[item.status]
      }
      items.push(value)
    })

    return items
  },
  outgoingRequests: (state, getter, rootGetter) => {
    let items = []
    state.items.forEach(item => {
      if (item.status >= 2 || item.lender_id !== rootGetter.auth.user.id) return
      const conditionIndex = item.book.bookshelf_item.find(bookshelfItem => bookshelfItem.id === item.bookshelf_item_id).condition
      const pickDateTime = DateTime.fromSQL(item.pickup_date)
      const proposedCollection = pickDateTime.toFormat('cccc, d LLLL')
      const timeSlot = pickDateTime.toFormat('t') + ' - ' + pickDateTime.plus({ hours: 2 }).toFormat('t')
      const value = {
        borrower: item.borrower.name,
        book: item.book.title,
        condition: rootGetter.library.conditions[conditionIndex].name,
        proposed_collection: proposedCollection,
        time_slot: timeSlot,
        status: state.status[item.status]
      }
      items.push(value)
    })

    return items
  }
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
