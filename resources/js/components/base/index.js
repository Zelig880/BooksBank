import Vue from 'vue'
import Card from './Card'
import Checkbox from './Checkbox'
import LocaleDropdown from './LocaleDropdown'

// Components that are registered globaly.
[
  Card,
  Checkbox,
  LocaleDropdown
].forEach(Component => {
  Vue.component(Component.name, Component)
})
