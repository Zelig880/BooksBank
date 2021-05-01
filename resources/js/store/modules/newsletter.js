import axios from 'axios'
import Swal from 'sweetalert2'

// state
export const state = {
  account: null
}

// getters
export const getters = {
}

// mutations
export const mutations = {
  SET_ACCOUNT (state, account) {
    state.account = account
  }
}

// actions
export const actions = {
  async createContact (context, email) {
    const { data } = await axios.post('/api/newsletter/createContact', { email })
    if (data) {
      Swal.fire({
        type: 'success',
        title: 'All done',
        text: 'Your email has been succesfully been added to our Newsletter!'
      })
    } else {
      Swal.fire({
        type: 'error',
        title: 'Server error',
        text: 'The request was not sent. Please try again later, and contact your administrator if the issue persist.'
      })
    }
  }
}
