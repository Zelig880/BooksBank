<template>
  <div>
    <div class="container flex flex-col md:flex-row py-4 mx-auto">
      <img class="w-10/12 mx-auto h-96 md:w-1/2" src="https://picsum.photos/400/400" alt="Add a book">
      <div class="mt-10 mx-4 flex flex-col">
        <h3 class="text-5xl font-bold mb-4 flex-grow">
          {{ $t('welcomeAdd-title') }}
        </h3>
        <p class="font-bold mb-2 flex-grow">
          {{ $t('welcomeAdd-subheading') }}
        </p>
        <p class="mb-4 flex-grow">
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

<style>

</style>
