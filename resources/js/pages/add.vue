<template>
  <div>
    <welcomeHowAdd />
    <welcomeFeatures />
    <welcomeAbout />
    <welcomeJoin />
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

import welcomeHowAdd from '~/components/sections/welcomeHowAdd'
import welcomeFeatures from '~/components/sections/welcomeFeatures'
import welcomeAbout from '~/components/sections/welcomeAbout'
import welcomeJoin from '~/components/sections/welcomeJoin'

export default {
  layout: 'default',

  components: {
    welcomeHowAdd,
    welcomeFeatures,
    welcomeAbout,
    welcomeJoin
  },

  metaInfo () {
    return { title: this.$t('add_a_book') }
  },

  data: () => ({
    title: window.config.appName
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  })
}
</script>

<style scoped>
.title {
  font-size: 85px;
}
</style>
