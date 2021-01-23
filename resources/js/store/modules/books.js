import axios from 'axios'

// state
export const state = {

}

// getters
export const getters = {
}

// mutations
export const mutations = {
}

// actions
export const actions = {
  async fetchBooksByISBN ({ commit }, isbn) {
    try {
      const { data } = await axios.get(`/api/books/isbn/${isbn}`)
      console.log(data)
    } catch (e) {
    }
  }

}
