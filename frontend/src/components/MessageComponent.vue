<script setup lang="ts">
import { computed, defineProps, onBeforeMount } from 'vue'
import type { Conversation } from '@/types/conversation'
import { useStore } from 'vuex'

let props = defineProps<Conversation>()
let store: ReturnType<typeof useStore>

onBeforeMount(() => {
  store = useStore()
})

const fileSendingText = computed(() => {
  let content: string = ''
  if (props.latestMessage.type === 'IMAGE')
    content = content + 'sent an image'
  else if (props.latestMessage.type === 'FILE')
    content = content + 'sent a file'

  if (props.latestMessage.owner.id === store.getters.getUserId)
    return 'You ' + content
  else
    return props.latestMessage.owner.username + ' ' + content

})

</script>

<template>
  <div class="flex items-center">
    <div class="relative w-fit h-fit">
      <div class="relative rounded-full overflow-hidden min-w-[50px] min-h-[50px]">
        <img class="w-[50px] h-[50px]" :src="avatarUrl" alt="" />
      </div>

      <div v-if="isActive"
           class="flex justify-center items-center absolute h-3 w-3 bg-white rounded-full bottom-1 right-0">
        <div class="mx-auto absolute h-2 w-2 bg-green rounded-full"></div>
      </div>

    </div>

    <div class="flex justify-between w-full">
      <div class="flex flex-col ml-[.938rem] max-w-[9.375rem]">

        <span class="overflow-hidden text-ellipsis text-nowrap text-soft font-bold">{{ title }}</span>

        <!--        <span class="text-sm text-green">Typing...</span>-->
        <div v-if="latestMessage.type === 'TEXT'"
             class="max-w-36 overflow-hidden text-ellipsis text-nowrap text-gray-primary text-sm">
          <span v-if="latestMessage.owner.id === store.getters.getUserId">You : </span> {{ latestMessage.content }}
        </div>

        <span v-if="latestMessage.type !== 'TEXT'"
              class="max-w-36 overflow-hidden text-ellipsis text-nowrap text-gray-primary text-sm">
          <span>{{ fileSendingText }}</span>
        </span>

      </div>
      <div class="flex flex-col items-end">
        <span class="text-gray-primary text-[.813rem]">{{ latestMessage.sentAt }}</span>
        <span
          class="flex items-center justify-center bg-primary rounded-full w-4 h-4 text-xs font-bold">
          {{ unreadMessagesCount }}
        </span>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
