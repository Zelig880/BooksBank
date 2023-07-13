import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// import { } from '@fortawesome/free-regular-svg-icons'

import {
  faUser, faLock, faSignOutAlt, faCog, faBars, faTimes, faEnvelope, faSearch, faMapMarkerAlt, faBook, faCheckDouble, faChevronRight, faHome, faCity, faBell, faPaperPlane
} from '@fortawesome/free-solid-svg-icons'

import {
  faGithub
} from '@fortawesome/free-brands-svg-icons'

library.add(
  faUser, faLock, faSignOutAlt, faCog, faGithub, faBars, faTimes, faEnvelope, faSearch, faMapMarkerAlt, faBook, faCheckDouble, faChevronRight, faHome, faCity, faBell, faPaperPlane
)

Vue.component('fa', FontAwesomeIcon)
