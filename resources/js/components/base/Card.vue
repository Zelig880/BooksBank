<template>
  <div class="grid grid-cols-5 gap-5 bg-white p-8 col-span-1 rounded-sm shadow-md hover:shadow-xl">
    <div class="col-span-1 mb-3">
      <img :src="thumbnail" :alt="`Cover for ${title}`">
    </div>
    <div class="col-span-4">
      <h3 v-if="title" class="text-lg font-bold">
        {{ title }}
      </h3>

      <p class="h-12">
        {{ formattedDescription }}
      </p>

      <div class="my-3">
        <fa icon="map-marker-alt" />
        {{ formattedDistance }} Miles</div>

      <div class="flex justify-between">
        <button class="flex items-center text-xs uppercase font-bold text-gray-800 hover:opacity-75 rounded-full py-3 px-8 bg-gray-200" @click="$emit('click')">
          Borrow
        </button>
        <span class="self-end">Condition: <span class="font-semibold">{{ condition }}</span></span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Card',

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
    condition: {
      type: String,
      required: true
    },
    distance: {
      type: Number,
      required: true
    }
  },
  computed: {
    formattedDistance () {
      return Math.round(this.distance * 10) / 10
    },
    formattedDescription () {
      const truncatedDescription = this.description.substring(0, 112)
      return truncatedDescription + '...'
    }
  }
}
</script>
