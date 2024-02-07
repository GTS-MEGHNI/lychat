<script setup lang="ts">
import SearchInputComponent from '@/components/SearchInputComponent.vue'
import MessageComponent from '@/components/MessageComponent.vue'
import { onMounted, ref } from 'vue'
import { useStore } from 'vuex'
import type { Conversation } from '@/types/conversation'

let store = null
let conversations = ref<Array<Conversation>>([])

onMounted(() => {
  store = useStore()
  conversations.value = store.getters.getConversations
})
</script>

<template>
  <div
    class="overflow-y-scroll overflow-x-hidden px-[1.875rem] h-full bg-dark-accent text-white w-[400px]"
  >
    <div class="mb-[1.563rem]">
      <h1 class="text-3xl font-bold pt-[1.813rem]">Messages</h1>
    </div>
    <div class="mb-[2.5rem]">
      <SearchInputComponent placeholder="search" iconPosition="START" />
    </div>
    <div class="flex flex-col gap-[1.875rem]">
      <div v-for="(conversation, index) in conversations" :key="index">
        <MessageComponent
          :id="conversation.id"
          :participants="conversation.participants"
          :latestMessage="conversation.latestMessage"
          :unreadMessagesCount="conversation.unreadMessagesCount"
          :createdAt="conversation.createdAt"
          :avatarUrl="conversation.avatarUrl"
          :isGroup="conversation.isGroup"
          :isMuted="conversation.isGroup"
          :isPinned="conversation.isPinned"
          :isArchived="conversation.isArchived"
        />
      </div>
    </div>
  </div>
</template>

<style scoped></style>
