<script setup lang="ts">
import ConversationMessageComponent from '@/components/conversation/ConversationMessageComponent.vue'
import SelfMadeMessageComponent from '@/components/conversation/SelfMadeMessageComponent.vue'
import { onBeforeMount, onMounted, ref } from 'vue'
import type { ConversationMessage } from '@/types/conversation'
import { useStore } from 'vuex'

let discussionMessages = ref < Array<ConversationMessage>([])

onBeforeMount(() => {
  let store = useStore()
  discussionMessages = store.getters.getDiscussionMessages
})
</script>

<template>
  <div
    class="overflow-y-scroll overflow-x-hidden bg-dark-surface w-full pl-[1.875rem] pt-[1.875rem] pr-[2.313rem] mb-4"
  >
    <div class="flex items-center text-soft mb-[3.75rem]">
      <div class="min-w-[3.75rem] min-h-[3.75rem] mr-[1.125rem]">
        <img src="../../assets/pictures/avatar-7.png" alt="" />
      </div>
      <div class="flex flex-col">
        <span class="text-3xl">Alexander Thompson</span>
        <span class="text-gray-primary text-sm">Active 4h ago</span>
      </div>
    </div>
    <div v-for="(discussionMessage, index) in discussionMessages" :key="index">
      <ConversationMessageComponent
        v-if="!discussionMessage.isCurrentUserMessage"
        :id="discussionMessage.id"
        :type="discussionMessage.type"
        :content="discussionMessage.content"
        :owner="discussionMessage.owner"
        :sentAt="discussionMessage.sentAt"
        :isCurrentUserMessage="discussionMessage.isCurrentUserMessage"
      />

      <SelfMadeMessageComponent
        v-else
        :id="discussionMessage.id"
        :type="discussionMessage.type"
        :content="discussionMessage.content"
        :owner="discussionMessage.owner"
        :sentAt="discussionMessage.sentAt"
        :isCurrentUserMessage="discussionMessage.isCurrentUserMessage"
      />
    </div>
  </div>
</template>

<style scoped></style>
