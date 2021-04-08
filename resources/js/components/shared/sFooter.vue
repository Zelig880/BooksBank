<template>
  <footer>
    <div class="container grid grid-cols-1 md:grid-cols-2 mx-auto">
      <img class="col-span-full mb-8" src="/assets/img/Logo-2-colour.svg" :alt="appName">
      <p class="col-span-1  mb-8">
        {{ $t('sFooter-text') }}
      </p>
      <div class="col-span-1 flex place-content-around  mb-8">
        <ul>
          <li><Anchor theme="none" routeName="test">text</Anchor></li>
          <li><Anchor theme="none" routeName="test">text</Anchor></li>
          <li><Anchor theme="none" routeName="test">text</Anchor></li>
        </ul>
        <ul>
          <li><Anchor theme="none" routeName="test">text</Anchor></li>
          <li><Anchor theme="none" routeName="test">text</Anchor></li>
          <li><Anchor theme="none" routeName="test">text</Anchor></li>
        </ul>
        <ul>
          <li><Anchor theme="none" routeName="test">text</Anchor></li>
          <li><Anchor theme="none" routeName="test">text</Anchor></li>
          <li><Anchor theme="none" routeName="test">text</Anchor></li>
        </ul>
      </div>
      <div class="col-span-1  mb-8">
        <span>facebook</span>
        <span>twitter</span>
        <span>instragram</span>
      </div>
      <p class="col-span-1 text-center mb-8">
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
