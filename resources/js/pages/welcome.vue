<template>
  <div>
    <welcomeSearch />
    <welcomeHow />
    <welcomeFeatures />
    <welcomeAdd />
    <welcomeAbout />
    <welcomeJoin />
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

import welcomeSearch from '~/components/sections/welcomeSearch'
import welcomeHow from '~/components/sections/welcomeHow'
import welcomeFeatures from '~/components/sections/welcomeFeatures'
import welcomeAdd from '~/components/sections/welcomeAdd'
import welcomeAbout from '~/components/sections/welcomeAbout'
import welcomeJoin from '~/components/sections/welcomeJoin'

export default {
  layout: 'default',

  components: {
    welcomeSearch,
    welcomeHow,
    welcomeFeatures,
    welcomeAdd,
    welcomeAbout,
    welcomeJoin
  },

  metaInfo () {
    return { title: this.$t('home') }
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
