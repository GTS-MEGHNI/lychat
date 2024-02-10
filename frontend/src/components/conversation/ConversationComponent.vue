<script setup lang="ts">
import ConversationMessageComponent from '@/components/conversation/ConversationMessageComponent.vue'
import SelfMadeMessageComponent from '@/components/conversation/SelfMadeMessageComponent.vue'
import { onBeforeMount, onMounted, onUnmounted, onUpdated, ref } from 'vue'
import type { ConversationMessage } from '@/types/conversation'
import { useStore } from 'vuex'
import type { Discussion } from '@/types/Discussion'
import store from '@/store'

let currentDiscussion = ref<Discussion | {}>({})
let discussionMessages = ref<Array<ConversationMessage>>([])
let messagesContainer = ref()
let currentDiscussionWatcher: ReturnType<typeof store.watch> = () => {}

onMounted(() => {
  let store = useStore()
  currentDiscussionWatcher = store.watch(
    () => store.getters.getCurrentDiscussion,
    (discussion: Discussion) => {
      currentDiscussion.value = discussion
      discussionMessages.value = discussion.messages
    }
  )
})

onUpdated(() => {
  messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight
})

onUnmounted(currentDiscussionWatcher)

function shouldDisplayInfoChecker(index: number): boolean {
  let previousMessage: ConversationMessage = discussionMessages.value[index - 1]
  return index === 0 ? true : discussionMessages.value[index].owner.id !== previousMessage.owner.id
}
</script>

<template>
  <div
    ref="messagesContainer"
    class="overflow-y-scroll overflow-x-hidden bg-dark-surface w-full pl-[1.875rem] pt-[1.875rem] pr-[2.313rem] mb-4"
  >
    <div v-if="Object.keys(currentDiscussion).length !== 0">
      <div class="flex items-center text-soft mb-[3.75rem]">
        <div class="w-[3.75rem] sh-[3.75rem] mr-[1.125rem]">
          <img :src="(currentDiscussion as Discussion).avatarUrl" alt="" />
        </div>
        <div class="flex flex-col">
          <span class="text-3xl">{{ (currentDiscussion as Discussion).title }}</span>
          <span class="text-gray-primary text-sm">Active now</span>
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
          :shouldDisplayInfo="shouldDisplayInfoChecker(index)"
        />

        <SelfMadeMessageComponent
          v-else
          :id="discussionMessage.id"
          :type="discussionMessage.type"
          :content="discussionMessage.content"
          :owner="discussionMessage.owner"
          :sentAt="discussionMessage.sentAt"
          :isCurrentUserMessage="discussionMessage.isCurrentUserMessage"
          :shouldDisplayInfo="shouldDisplayInfoChecker(index)"
        />
      </div>
    </div>
  </div>
</template>

<style scoped></style>
