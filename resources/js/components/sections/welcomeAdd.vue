<template>
  <div class="welcomeAdd py-8 md:py-40 px-8 lg:px-0">
    <div class="container flex flex-col md:flex-row mx-auto">
      <div class="hidden md:inline-block lg:w-1/2 mr-9">
        <img class="welcomeAdd_illustration" src="/assets/img/add-a-book.svg" alt="Illustration of lady reading a book">
      </div>
      <div class="flex flex-col lg:w-1/2 lg:mr-14">
        <h3 class="Light-backgroundH1---h6H2 mb-4 flex-grow">
          {{ $t('welcomeAdd-title') }}
        </h3>
        <sub class="Light-backgroundH1---h6H4 mb-2 flex-grow">
          {{ $t('welcomeAdd-subheading') }}
        </sub>
        <p class="Light-backgroundBody-textStadard-body-18px mb-4 flex-grow">
          {{ $t('welcomeAdd-paragraph') }}
        </p>
        <Anchor class="px-12 py-3 w-48 md:w-1/2" route-name="bookshelf.add">
          {{ $t('welcomeAdd-cta') }}
        </Anchor>
      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
.welcomeAdd{
  background-color: var(--img-holder);
}
</style>
