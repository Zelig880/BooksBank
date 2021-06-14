<template>
  <footer class="mt-8">
    <div class="container grid grid-cols-1 md:grid-cols-2 mx-auto">
      <div class="col-span-1">
        <img class="mb-8" src="/assets/img/Logo-2-colour.svg" :alt="appName">
        <p class="">
          {{ $t('sFooter-text') }}
        </p>
      </div>
      <div class="col-span-1 flex place-content-around  mb-8">
        <ul>
          <li><Anchor theme="none" routeName="welcome">Home</Anchor></li>
          <li><Anchor theme="none" routeName="bookshelf.all">My Library</Anchor></li>
          <li><Anchor theme="none" routeName="bookshelf.info">My Requests</Anchor></li>
          <li><Anchor theme="none" routeName="bookshelf.settings">My Settings</Anchor></li>
        </ul>
        <ul>
          <li><Anchor theme="none" routeName="about">About</Anchor></li>
          <li><Anchor theme="none" routeName="terms">Terms and Condition</Anchor></li>
          <li><Anchor theme="none" routeName="privacy">Privacy Policy</Anchor></li>
          <li><Anchor theme="none" routeName="bookshelf.add">Add a Book</Anchor></li>
        </ul>
      </div>
      <p class="col-span-full text-right mb-8">
        @copyright Zelig880 LTD
      </p>
    </div>
  </footer>
</template>

<script>
export default {
  data () {
    return {
      appName: window.config.appName
    }
  }
}
</script>

<style>

</style>
