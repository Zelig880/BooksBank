<template>
  <div class="flex bookshelfAddSteps">
    <div class="w-1/3 text-center px-6" :class="step1Status">
      <div class="rounded-lg flex items-center justify-center border">
        <div class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
          <fa icon="search" size="2x" />
        </div>
        <div class="w-2/3 bg-gray-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
          <h2 class="font-bold text-sm">
            {{ $t('bookshelfAdd-step1-title') }}
          </h2>
          <p class="text-xs text-gray-600">
            {{ $t('bookshelfAdd-step1-description') }}
          </p>
        </div>
      </div>
    </div>
    <div class="flex-1 flex items-center justify-center">
      <fa icon="chevron-right" size="2x" class="text-gray-600" />
    </div>
    <div class="w-1/3 text-center px-6" :class="step2Status">
      <div class="rounded-lg flex items-center justify-center border">
        <div class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
          <fa icon="book" size="2x" class="text-gray-500" />
        </div>
        <div class="w-2/3 bg-gray-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
          <h2 class="font-bold text-sm">
            {{ $t('bookshelfAdd-step2-title') }}
          </h2>
          <p class="text-xs text-gray-600">
            {{ $t('bookshelfAdd-step2-description') }}
          </p>
        </div>
      </div>
    </div>
    <div class="flex-1 flex items-center justify-center">
      <fa icon="chevron-right" size="2x" class="text-gray-600" />
    </div>
    <div class="w-1/3 text-center px-6" :class="step3Status">
      <div class="rounded-lg flex items-center justify-center border">
        <div class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
          <fa icon="check-double" size="2x" class="text-gray-500" />
        </div>
        <div class="w-2/3 bg-gray-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
          <h2 class="font-bold text-sm">
            {{ $t('bookshelfAdd-step3-title') }}
          </h2>
          <p class="text-xs text-gray-600">
            {{ $t('bookshelfAdd-step3-description') }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BookshelfAddSteps',
  props: {
    currentStep: {
      type: Number,
      required: true
    }
  },
  computed: {
    step1Status () {
      switch (this.currentStep) {
        case 0:
          return 'inactive'
        case 1:
          return 'active'
        default:
          return 'completed'
      }
    },
    step2Status () {
      switch (this.currentStep) {
        case 0:
        case 1:
          return 'inactive'
        case 2:
          return 'active'
        default:
          return 'completed'
      }
    },
    step3Status () {
      switch (this.currentStep) {
        case 0:
        case 1:
        case 2:
          return 'inactive'
        case 3:
          return 'active'
        default:
          return 'completed'
      }
    }
  }
}
</script>

<style lang="scss">
.bookshelfAddSteps .inactive{
  & > div {
    @apply bg-gray-200 border-gray-100;
  }

  svg {
    @apply text-gray-500;
  }

  .body-step{
    @apply bg-gray-100;
  }
}
.bookshelfAddSteps .active{
  & > div {
    @apply bg-blue-200 border-blue-100;
  }

  svg {
    @apply text-blue-500;
  }

  .body-step{
    @apply bg-blue-100;
  }
}
.bookshelfAddSteps .completed{
  & > div {
    @apply bg-green-200 border-green-100;
  }

  svg {
    @apply text-green-500;
  }

  .body-step{
    @apply bg-green-100;
  }
}
</style>
