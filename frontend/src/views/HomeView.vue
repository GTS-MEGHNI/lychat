<script setup lang="ts">
import SideBarComponent from '@/components/SideBarComponent.vue'
import ConversationComponent from '@/components/conversation/ConversationComponent.vue'
import MessageInputComponent from '@/components/conversation/MessageInputComponent.vue'
import MessagesContainerComponent from '@/components/MessagesContainerComponent.vue'
import { ref } from 'vue'

const conversationRef = ref()

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
          <div class="overflow-y-scroll h-full overflow-hidden mb-4" ref="conversationRef" >
            <ConversationComponent @discussionUpdated="scrollConversationToBottom"/>
          </div>
          <MessageInputComponent @messageSent="scrollConversationToBottom" />
        </div>
      </div>
    </div>
  </Transition>
</template>

<style scoped>
/*noinspection CssUnusedSymbol*/
.leave-active-class {
  transition: transform 0.3s ease, opacity 0.3s ease;
}
/*noinspection CssUnusedSymbol*/
.leave-to-class {
  opacity: 0;
  transform: translateX(20px);
}
</style>
