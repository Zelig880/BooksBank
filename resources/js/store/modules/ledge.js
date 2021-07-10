import axios from 'axios'
import { DateTime } from 'luxon'

// state
export const state = {
  items: [],
  status: [
    'WaitingApproval',
    'WaitingPickup',
    'InProgress',
    'ReturnRequested',
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
      if (item.borrower_id !== rootGetter.auth.user.id || item.status !== 2 || item.status !== 5) return
      const conditionIndex = item.book.bookshelf_item.find(bookshelfItem => bookshelfItem.id === item.bookshelf_item_id).condition
      const returnDate = DateTime.fromISO(item.return_date).toUTC().toFormat('cccc, d LLLL')
      const value = {
        id: item.id,
        bookshelf_item_id: item.bookshelf_item_id,
        borrower: item.borrower.name,
        book: item.book.title,
        condition: rootGetter.library.conditions[conditionIndex].name,
        return_date: returnDate
      }
      items.push(value)
    })

    return items
  },
  borrowedWithDetails: (state, getter, rootGetter) => {
    let items = []
    state.items.forEach(item => {
      if (item.borrower_id !== rootGetter.auth.user.id || item.status !== 2 || item.status !== 5) return
      items.push(item)
    })

    return items
  },
  lent: (state, getter, rootGetter) => {
    let items = []
    state.items.forEach(item => {
      if (item.lender_id !== rootGetter.auth.user.id || item.status !== 2 || item.status !== 5) return
      const conditionIndex = item.book.bookshelf_item.find(bookshelfItem => bookshelfItem.id === item.bookshelf_item_id).condition
      const returnDate = DateTime.fromISO(item.return_date).toUTC().toFormat('cccc, d LLLL')
      const value = {
        id: item.id,
        bookshelf_item_id: item.bookshelf_item_id,
        borrower: item.borrower.name,
        book: item.book.title,
        condition: rootGetter.library.conditions[conditionIndex].name,
        return_date: returnDate
      }
      items.push(value)
    })

    return items
  },
  incomingRequests: (state, getter, rootGetter) => {
    let items = []
    state.items.forEach(item => {
      if (item.status === 2 || item.lender_id !== rootGetter.auth.user.id) return
      const conditionIndex = item.book.bookshelf_item.find(bookshelfItem => bookshelfItem.id === item.bookshelf_item_id).condition
      const pickDateTime = DateTime.fromISO(item.pickup_date).toUTC()
      const proposedCollection = pickDateTime.toFormat('cccc, d LLLL')
      const timeSlot = pickDateTime.toFormat('t') + ' - ' + pickDateTime.plus({ hours: 2 }).toFormat('t')
      const value = {
        id: item.id,
        borrower: item.borrower.name,
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
      if (item.status === 2 || item.borrower_id !== rootGetter.auth.user.id) return
      const conditionIndex = item.book.bookshelf_item.find(bookshelfItem => bookshelfItem.id === item.bookshelf_item_id).condition
      const pickDateTime = DateTime.fromISO(item.pickup_date).toUTC()
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
  getItemByLedgeId: state => ledgeId => {
    return state.items.find(item => item.id === ledgeId)
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
    if (data.status) {
      commit('SET_ITEMS', data.data)
    }
  },
  async request ({ commit }, payload) {
    const { data } = await axios.post(`/api/ledge/request`, payload)
    console.log(data)
  },
  async respond ({ commit }, { ledgeId, response }) {
    const { data } = await axios.put(`/api/ledge/request/respond/${ledgeId}`, { response })
    console.log(data)
  },
  async collect ({ commit }, { ledgeId }) {
    const { data } = await axios.put(`/api/ledge/collect/${ledgeId}`)
    console.log(data)
  },
  async returnRequest ({ commit }, payload) {
    const { data } = await axios.post(`/api/ledge/return_request`, payload)
    console.log(data)
  },
  async returnRespond ({ commit }, { ledgeId, response }) {
    const { data } = await axios.put(`/api/ledge/return_request/respond/${ledgeId}`, { response })
    console.log(data)
  },
  async returned ({ commit }, { ledgeId }) {
    const { data } = await axios.put(`/api/ledge/returned/${ledgeId}`)
    console.log(data)
  }
}
