<script setup lang="ts">
import { defineProps, onBeforeMount } from 'vue'
import type { Conversation } from '@/types/conversation'
import { useStore } from 'vuex'

defineProps<Conversation>()
let store: ReturnType<typeof useStore>

onBeforeMount(() => {
  store = useStore()
})
</script>

<template>
  <div class="flex items-center">
    <div class="rounded-full overflow-hidden min-w-[50px] min-h-[50px]">
      <img class="w-[50px] h-[50px]" :src="avatarUrl" alt="" />
    </div>
    <div class="flex justify-between w-full">
      <div class="flex flex-col ml-[.938rem] max-w-[9.375rem]">

        <span class="overflow-hidden text-ellipsis text-nowrap text-soft font-bold">Conversation N° {{ id }}</span>

        <!--        <span class="text-sm text-green">Typing...</span>-->
        <div v-if="latestMessage.type === 'TEXT'"
             class="overflow-hidden text-ellipsis text-nowrap text-gray-primary text-sm">
          <span v-if="latestMessage.owner.id === store.getters.getUserId">You : </span> {{ latestMessage.content }}
        </div>

        <span v-if="latestMessage.type === 'IMAGE'"
              class="overflow-hidden text-ellipsis text-nowrap text-gray-primary text-sm">
          <span v-if="latestMessage.owner.id === store.getters.getUserId">You</span> sent an image
        </span>

      </div>
      <div class="flex flex-col items-end">
        <span class="text-gray-primary text-[.813rem]">{{ latestMessage.sentAt }}</span>
        <span
          class="flex items-center justify-center bg-primary rounded-full w-4 h-4 text-xs font-bold"
        >{{ unreadMessagesCount }}
        </span>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
