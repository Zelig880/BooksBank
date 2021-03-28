<template>
  <div class="grid grid-cols-5 gap-5 bg-white py-8 mx-10 border-b-2">
    <div class="col-span-1 mb-3">
      <img :src="thumbnail" :alt="`Cover for ${title}`">
    </div>
    <div class="col-span-4 mt-8 ml-3 items-stretch">
      <h3 v-if="title" class="text-lg font-bold">
        {{ title }}
      </h3>

      <p class="h-12">
        {{ formattedDescription }}
      </p>

      <div class="flex justify-between mt-4">
        <span class="self-end">ISBN: <span class="font-semibold">{{ ISBN }}</span></span>
        <button class="flex items-center text-xs uppercase font-bold text-gray-800 hover:opacity-75 rounded-full py-3 px-8 bg-gray-200" @click="$emit('click')">
          Select
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BookshelfAddCard',

  props: {
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    },
    thumbnail: {
      type: String,
      required: false,
      default: 'https://picsum.photos/300/500'
    },
    // eslint-disable-next-line vue/prop-name-casing
    ISBN: {
      type: String,
      required: true
    }
  },
  computed: {
    formattedDescription () {
      const truncatedDescription = this.description.substring(0, 80)
      return truncatedDescription + '...'
    }
  }
}
</script>
