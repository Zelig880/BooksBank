import Vue from 'vue'
import Checkbox from './Checkbox'
import LocaleDropdown from './LocaleDropdown'
import Button from './Button'
import Anchor from './Anchor'

// Components that are registered globaly.
[
  Checkbox,
  LocaleDropdown,
  Button,
  Anchor
].forEach(Component => {
  Vue.component(Component.name, Component)
})
