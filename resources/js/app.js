import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
import PerfectScrollbar from 'vue2-perfect-scrollbar'
import 'vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css'

import '~/plugins'
import '~/components'
import '~/components/base'

Vue.component('date-picker', DatePicker)
Vue.use(PerfectScrollbar)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
