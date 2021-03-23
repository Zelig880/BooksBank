<template>
  <div>
    <h3 class="text-2xl font-bold">
      {{ $t( 'bookshelfAdd-step3-title' ) }}
    </h3>
    <p> {{ $t( 'bookshelfAdd-step3-description' ) }} </p>
    <img :src="thumbnail" :alt="`Cover for ${title}`">
    <div>
      <p><span class="font-bold">Title:</span>{{ title }}</p>
      <p><span class="font-bold">Description:</span>{{ description }}</p>
      <p><span class="font-bold">ISBN:</span>{{ ISBN }}</p>
      <p><span class="font-bold">Condition:</span>{{ conditions[condition].name }}</p>
      <Button @click="$emit('select', 'Accept')">Accept and add</Button>
      <Button @click="$emit('select', 'Reject')">Reject</Button>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'BookshelfAddStep3',
  props: {
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    },
    ISBN: {
      type: String,
      required: true
    }, 
    condition: {
      type: Number,
      required: true
    },
    thumbnail: {
      type: String,
      required: true
    }, 
  },
  computed: {
    ...mapState('library', ['conditions'])
  },
}
</script>

<style>

</style>
