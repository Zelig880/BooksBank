<template>
  <div class="main-layout">
    <sNavbar />

    <div class="flex-1">
      <child />
    </div>

    <sFooter />
  </div>
</template>

<script>
import sNavbar from '~/components/shared/sNavbar'
import sFooter from '~/components/shared/sFooter'

export default {
  name: 'MainLayout',

  components: {
    sNavbar,
    sFooter
  }
}
</script>

<style lang="scss">
.main-layout{
  height: 100vh;
  display: flex;
  flex-direction: column;
}
</style>
