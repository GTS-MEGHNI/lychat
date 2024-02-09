<script setup lang="ts">
import SideBarComponent from '@/components/SideBarComponent.vue'
import ConversationComponent from '@/components/conversation/ConversationComponent.vue'
import MessageInputComponent from '@/components/MessageInputComponent.vue'
import MessagesContainerComponent from '@/components/MessagesContainerComponent.vue'
import { type Ref, ref } from 'vue'

const conversationRef: Ref<HTMLDivElement | undefined> = ref(undefined)

function scrollConversationToBottom() {
  if (conversationRef.value) {
    conversationRef.value.scrollTop = conversationRef.value.scrollHeight
  }
}
</script>

<template>
  <SideBarComponent />
  <div class="h-full ml-[5.875rem] w-[calc(100%-5.875rem)]">
    <div class="flex h-full">
      <MessagesContainerComponent />
      <div class="flex flex-col w-full justify-between">
        <ConversationComponent ref="conversationRef" />
        <MessageInputComponent @messageSent="scrollConversationToBottom" />
      </div>
    </div>
  </div>
</template>

<style scoped></style>
