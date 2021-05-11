<template>
  <div>
    <div>
      <h2 class="mt-8 mb-8 text-2xl font-bold">
        {{ $t('register_title') }}
      </h2>
      <p class="mt-4 mb-8">
        {{ $t('register_description') }}
      </p>
      <button class="w-full rounded-full py-3 border-2 mb-2" @click="handleClick('google')">
        {{ $t('continue-with-google') }}
      </button>
      <button class="w-full rounded-full py-3 border-2 bg-gray-400 text-white mb-2" @click="handleClick('facebook')">
        {{ $t('continue-with-facebook') }}
      </button>
      <button class="w-full rounded-full py-3 border-2 bg-gray-700 text-white" @click="handleClick('twitter')">
        {{ $t('continue-with-twitter') }}
      </button>
    </div>
    <div class="flex my-8">
      <span class="border-b-2 flex-grow mb-3" />
      <span class="mx-4 text-gray-400">OR</span>
      <span class="border-b-2 flex-grow mb-3" />
    </div>
    <button class="w-full rounded-2 py-3 border-2" @click="handleClick('email')">
      {{ $t('register_with_email') }}
    </button>
  </div>
</template>

<script>
export default {
  methods: {
    handleClick (type) {
      this.$emit('click', type)
    }
  }
}
</script>

<style>

</style>