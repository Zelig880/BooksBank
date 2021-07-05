function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  //Static pages
  { path: '/privacy', name: 'privacy', component: page('privacy.vue') },
  { path: '/terms', name: 'terms', component: page('terms.vue') },
  { path: '/safe', name: 'safe', component: page('safe.vue') },
  { path: '/about', name: 'about', component: page('about.vue') },

  //Registration Process
  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/library', 
    component: page('library.vue'),
    children: [
      { path: '', redirect: { name: 'library.home' } },
      { path: 'home', name: 'library.home', component: page('library/home.vue') },
      { path: 'view/:latitude/:longitude/:radius/:searchTitle?', name: 'library.view', component: page('library/view.vue') },
      { path: 'borrow/:bookshelfItemId', name: 'library.borrow', component: page('library/borrow.vue') },
    ] 
  },
  { path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ] },
  { path: '/bookshelf/add', name: 'bookshelf.add', component: page('bookshelf/add.vue') },
  { path: '/bookshelf',
    component: page('bookshelf/index.vue'),
    children: [
      { path: '', redirect: { name: 'bookshelf.settings' } },
      { path: 'settings', name: 'bookshelf.settings', component: page('bookshelf/settings.vue') },
      { path: 'all', name: 'bookshelf.all', component: page('bookshelf/all.vue') },
      { path: 'requested', name: 'bookshelf.requested', component: page('bookshelf/requested.vue') },
      { path: 'info', name: 'bookshelf.info', component: page('bookshelf/info.vue'), alias: ['info/incoming', 'info/outgoing', 'info/borrowed', 'info/loaned'] },
    ] },

  { path: '*', component: page('errors/404.vue') }
]
