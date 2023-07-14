<template>
  <Modal :show="show" @close="$emit('close')">
    <template v-slot:body>
      <div class="messageModal">
        <div class="w-full px-5 flex flex-col justify-between mt-6">
          <perfect-scrollbar ref="messageContainerRef" class="messageModal__container" >
            <div v-for="{ message, id, user_id } in currentLedgeMessages" class="flex mb-4" :key="id" :class="getMessageJustify(user_id)">
              <div :class="getMessageStyle(user_id)">
                {{ message }}
              </div>
            </div>
          </perfect-scrollbar>
          <form class="py-5 flex" @submit.prevent="onSendRequest">
            <input v-model="currentMessage" class="w-full bg-gray-300 py-5 px-3 rounded-xl" type="text" placeholder="type your message here...">
            <Button theme="icon" class="ml-5 self-center bg-blue-300" @click="onSendRequest">
              <fa icon="paper-plane" aria-label="messages" />
            </Button>
          </form>
        </div>
      </div>
    </template>
  </Modal>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Swal from 'sweetalert2'

export default {
  props: {
    show: {
      type: Boolean,
      required: true
    },
    ledgeId: {
      type: Number,
      required: false,
      default: null
    }
  },
  data () {
    return {
      currentMessage: ''
    }
  },
  computed: {
    ...mapGetters('ledge', ['getItemByLedgeId']),
    ...mapGetters('auth', ['user']),
    currentLedgeMessages () {
      return this.getItemByLedgeId(this.ledgeId)?.ledge_message
    },
    submitDisabled () {
      return this.currentMessage === ''
    }
  },
  methods: {
    ...mapActions('ledge', ['sendMessage']),
    async onSendRequest () {
      try {
        const payload = {
          ledge_id: this.ledgeId,
          message: this.currentMessage
        }
        await this.sendMessage(payload)
        this.currentMessage = ''
      } catch (error) {
        Swal.fire({
          type: 'error',
          title: 'Ops, sorry!!',
          text: 'Something went wrong. Please try again later.'
        })
      }
    },
    getMessageJustify (userId) {
      return this.user.id === userId ? 'justify-end' : 'justify-start'
    },
    getMessageStyle (userId) {
      return this.user.id === userId ? 'leftMessage' : 'rightMessage'
    },
    scrollMessageContainer () {
      const messageContainerRef = this.$refs['messageContainerRef']
      if (messageContainerRef) {
        messageContainerRef.$el.scrollTo(0, messageContainerRef.$el.scrollHeight)
      }
    }
  },
  watch: {
    currentLedgeMessages: {
      handler () {
        this.$nextTick().then(
          () => this.scrollMessageContainer()
        )
      },
      immediate: true,
      flush: 'post'
    }
  },
  mounted () {
    this.scrollMessageContainer()
  }
}
</script>

<style lang="scss">
.messageModal{
  &__container{
    @apply flex flex-col mt-5 overflow-scroll;
  }
  .ps {
    height: 300px;
  }
  .textarea {
    @apply rounded-lg border-2 border-gray-500 mt-2 w-auto px-7 py-4 text-center font-bold;
    width: 100%;
  }
  .leftMessage {
    @apply mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white;
  }
  .rightMessage {
    @apply ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white;
  }
}
</style>
