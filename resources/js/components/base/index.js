import Vue from 'vue'
import Card from './Card'
import Checkbox from './Checkbox'
import LocaleDropdown from './LocaleDropdown'
import Button from './Button'
import Link from './Link'

// Components that are registered globaly.
[
  Card,
  Checkbox,
  LocaleDropdown,
  Button,
  Link
].forEach(Component => {
  Vue.component(Component.name, Component)
})
