import Vue from 'vue'
import Checkbox from './Checkbox'
import LocaleDropdown from './LocaleDropdown'
import Button from './Button'
import Anchor from './Anchor'
import LendTimeslot from './LendTimeSlot'
import Modal from './Modal'
import CountryDropdown from './CountryDropdown'

// Components that are registered globaly.
[
  Checkbox,
  LocaleDropdown,
  Button,
  Anchor,
  LendTimeslot,
  Modal,
  CountryDropdown
].forEach(Component => {
  Vue.component(Component.name, Component)
})
