<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue'
import { useStore } from 'vuex'
import SearchInputComponent from '@/components/SearchInputComponent.vue'
import MessageComponent from '@/components/MessageComponent.vue'
import type { Conversation } from '@/types/conversation'
import { ConversationsService } from '@/services/ConversationsService'
import store from '@/store'

let conversations = ref<Conversation[]>([])
let watcher: ReturnType<typeof store.watch> = () => {}

onMounted(() => {
  let store = useStore()
  ConversationsService.fetchConversations()
  watcher = store.watch(() => store.getters.getConversations,
    (fetchedConversations: Conversation[]) => {
      conversations.value = fetchedConversations
    })
})

onUnmounted(watcher)

function loadConversation(conversationId: number) {
  ConversationsService.loadConversation(conversationId)
}
</script>

<template>
  <div
    class="overflow-y-auto overflow-x-hidden px-[1.875rem] h-full bg-dark-accent text-white w-[400px]"
  >
    <div class="mb-[1.563rem]">
      <h1 class="text-3xl font-bold pt-[1.813rem]">Messages</h1>
    </div>
    <div class="mb-[2.5rem]">
      <SearchInputComponent placeholder="search" iconPosition="START" />
    </div>
    <div class="flex flex-col">
      <div
        class="hover:bg-dark-accent hover:cursor-pointer pb-[1.875rem]"
        v-for="(conversation, index) in conversations"
        :key="index"
      >
        <MessageComponent
          :id="conversation.id"
          :participants="conversation.participants"
          :latestMessage="conversation.latestMessage"
          :unreadMessagesCount="conversation.unreadMessagesCount"
          :avatarUrl="conversation.avatarUrl"
          :isGroup="conversation.isGroup"
          :isMuted="conversation.isGroup"
          :isPinned="conversation.isPinned"
          :isArchived="conversation.isArchived"
          @click="loadConversation(conversation.id as number)"
          :ref="conversation.id"
        />
      </div>
    </div>
  </div>
</template>

<style scoped></style>
