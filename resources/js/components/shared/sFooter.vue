<template>
  <footer class="mt-8">
    <div class="container grid grid-cols-1 md:grid-cols-2 px-6 lg:px-0 lg:mx-auto">
      <div class="col-span-1">
        <img class="mb-8" src="/assets/img/Logo-2-colour.svg" :alt="appName">
        <p class="">
          {{ $t('sFooter-text') }}
        </p>
      </div>
      <div class="col-span-1 flex place-content-around  mb-8">
        <ul>
          <li>
            <Anchor theme="none" route-name="welcome">
              Home
            </Anchor>
          </li>
          <li>
            <Anchor theme="none" route-name="bookshelf.all">
              My Library
            </Anchor>
          </li>
          <li>
            <Anchor theme="none" route-name="bookshelf.info">
              My Requests
            </Anchor>
          </li>
          <li>
            <Anchor theme="none" route-name="bookshelf.settings">
              My Settings
            </Anchor>
          </li>
        </ul>
        <ul>
          <li>
            <Anchor theme="none" route-name="about">
              About
            </Anchor>
          </li>
          <li>
            <Anchor theme="none" route-name="terms">
              Terms and Condition
            </Anchor>
          </li>
          <li>
            <Anchor theme="none" route-name="privacy">
              Privacy Policy
            </Anchor>
          </li>
          <li>
            <Anchor theme="none" route-name="bookshelf.add">
              Add a Book
            </Anchor>
          </li>
        </ul>
      </div>
      <p class="col-span-full text-right my-8 text-gray-400">
        	&copy;2021 Zelig880 LTD.
      </p>
    </div>
    <cookie-law />
  </footer>
</template>

<script>
import CookieLaw from 'vue-cookie-law'
export default {
  components: {
    CookieLaw
  },
  data () {
    return {
      appName: window.config.appName
    }
  }
}
</script>

<style>

</style>
