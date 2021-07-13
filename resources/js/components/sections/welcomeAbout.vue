<template>
  <div class="welcomeAbout py-8 md:py-40">
    <div class="container px-4 mx-auto my-12 flex items-center justify-between">
      <div class="inline-block md:w-4/6 lg:w-1/2 md:mr-16">
        <h3 class="Light-backgroundH1---h6H2 mb-4">{{ $t('welcomeAbout-title') }}</h3>
        <p class="Light-backgroundH1---h6H4 mb-3">{{ $t('welcomeAbout-paragraph1') }}</p>
        <p class="Light-backgroundH1---h6H4">{{ $t('welcomeAbout-paragraph2') }}</p>
      </div>
      <div class="hidden md:inline-block md:w-2/6 lg:w-1/2">
        <img class="welcomeAbout_illustration" src="/assets/img/about-img.svg" alt="Illustration of a man sitting down reading a book">
      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
.welcomeAbout{
  background-color: var(--light-3);
}
</style>