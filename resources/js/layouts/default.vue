<template>
  <div class="main-layout">
    <sNavbar />

    <div class="container mt-4">
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
