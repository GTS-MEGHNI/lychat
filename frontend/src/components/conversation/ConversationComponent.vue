<script setup lang="ts">
import { onMounted, onUnmounted, onUpdated, ref } from 'vue'
import type { ConversationMessage } from '@/types/conversation'
import { useStore } from 'vuex'
import type { Discussion } from '@/types/Discussion'
import store from '@/store'
import ConversationHeaderComponent from '@/components/conversation/ConversationHeaderComponent.vue'
import DiscussionComponent from '@/components/conversation/DiscussionComponent.vue'

let currentDiscussion = ref<Discussion | {}>({})
let discussionMessages = ref<Array<ConversationMessage>>([])
let messagesContainer = ref()
let currentDiscussionWatcher: ReturnType<typeof store.watch> = () => {
}

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


</script>

<template>
  <div
    ref="messagesContainer"
    class="overflow-y-scroll overflow-x-hidden bg-dark-surface w-full pl-[1.875rem] pt-[1.875rem] pr-[2.313rem] mb-4"
  >
    <div v-if="Object.keys(currentDiscussion).length !== 0">
      <ConversationHeaderComponent :avatarUrl="(currentDiscussion as Discussion).avatarUrl"
                                   :title="(currentDiscussion as Discussion).title" />
      <DiscussionComponent :discussionMessages="discussionMessages"/>
      </div>
    </div>
</template>

<style scoped></style>
