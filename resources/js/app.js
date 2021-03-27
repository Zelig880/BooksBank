import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

import '~/plugins'
import '~/components'
import '~/components/base'

Vue.component('date-picker', DatePicker)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
