<script setup lang="ts">
import SideBarComponent from '@/components/SideBarComponent.vue'
import ConversationComponent from '@/components/conversation/ConversationComponent.vue'
import MessageInputComponent from '@/components/conversation/MessageInputComponent.vue'
import MessagesContainerComponent from '@/components/MessagesContainerComponent.vue'
import { type Ref, ref } from 'vue'

const conversationRef: Ref<HTMLDivElement | undefined> = ref(undefined)

function scrollConversationToBottom() {
  if (conversationRef.value) {
    conversationRef.value.scrollTop = conversationRef.value.scrollHeight
  }
}

let shouldAppear = ref<boolean>(true)

function fadeComponent() {
  shouldAppear.value = false
}
</script>

<template>
  <Transition
    mode="out-in"
    name="fade"
    leave-active-class="leave-active-class"
    leave-to-class="leave-to-class"
    appear>
    <div v-if="shouldAppear" class="h-full">
      <div class="flex h-full">
        <SideBarComponent @logout="fadeComponent" />
        <MessagesContainerComponent />
        <div class="flex flex-col w-full justify-between">
          <ConversationComponent ref="conversationRef" />
          <MessageInputComponent @messageSent="scrollConversationToBottom" />
        </div>
      </div>
    </div>
  </Transition>
</template>

<style scoped>
.leave-active-class {
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.leave-to-class {
  opacity: 0;
  transform: translateX(20px);
}
</style>
