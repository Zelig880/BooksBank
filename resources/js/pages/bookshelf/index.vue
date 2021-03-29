<template>
  <div>
    <router-view />
  </div>
</template>

<script>
export default {
  middleware: 'auth'
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
