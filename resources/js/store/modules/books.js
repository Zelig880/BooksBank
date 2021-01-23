import { findIconDefinition } from '@fortawesome/fontawesome-svg-core'
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
  async find ({ commit, dispatch }, { type, text }) {
    const { data } = await axios.get(`/api/books/${type}/${text}`)

    console.log(data)
  }
}
