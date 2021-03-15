import store from '~/store'

export default async (to, from, next) => {
  if (!store.getters['auth/check']) {
    next({ name: 'login', query: { redirect: to.path } })
  } else {
    next()
  }
}
