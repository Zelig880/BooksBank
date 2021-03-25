import Vue from 'vue'
import Checkbox from './Checkbox'
import LocaleDropdown from './LocaleDropdown'
import Button from './Button'
import Anchor from './Anchor'
import LendTimeslot from './LendTimeslot'
import BorrowTimeslot from './BorrowTimeslot'

// Components that are registered globaly.
[
  Checkbox,
  LocaleDropdown,
  Button,
  Anchor,
  LendTimeslot,
  BorrowTimeslot
].forEach(Component => {
  Vue.component(Component.name, Component)
})
