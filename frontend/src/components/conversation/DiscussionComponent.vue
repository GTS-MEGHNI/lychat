<script setup lang="ts">
import ConversationMessageComponent from '@/components/conversation/ConversationMessageComponent.vue'
import SelfMadeMessageComponent from '@/components/conversation/SelfMadeMessageComponent.vue'
import type { ConversationMessage } from '@/types/conversation'

const props = defineProps({
  discussionMessages: {
    type: Array as () => ConversationMessage[],
    required: true
  }
})

function shouldDisplayInfoChecker(index: number): boolean {
  let previousMessage: ConversationMessage = props.discussionMessages[index - 1]
  return index === 0 ? true : props.discussionMessages[index].owner.id !== previousMessage.owner.id
}

</script>

<template>
  <div class="flex flex-col">
    <div v-for="(discussionMessage, index) in discussionMessages" :key="index">
      <ConversationMessageComponent
        v-if="!discussionMessage.isCurrentUserMessage"
        :id="discussionMessage.id"
        :type="discussionMessage.type"
        :content="discussionMessage.content"
        :owner="discussionMessage.owner"
        :sentAt="discussionMessage.sentAt"
        :isCurrentUserMessage="discussionMessage.isCurrentUserMessage"
        :shouldDisplayInfo="shouldDisplayInfoChecker(index)" />
      <SelfMadeMessageComponent
        v-else
        :id="discussionMessage.id"
        :type="discussionMessage.type"
        :content="discussionMessage.content"
        :owner="discussionMessage.owner"
        :sentAt="discussionMessage.sentAt"
        :isCurrentUserMessage="discussionMessage.isCurrentUserMessage"
        :shouldDisplayInfo="shouldDisplayInfoChecker(index)" />
    </div>
  </div>

</template>

<style scoped>

</style>