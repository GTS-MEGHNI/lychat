<script setup lang="ts">
import type { ConversationMessage } from '@/types/conversation'
import { ref } from 'vue'

defineProps<ConversationMessage>()

let shouldDisplayInfo = ref<boolean>(true)
</script>

<template>
  <div class="w-full flex justify-end">
    <div class="mr-2">
      <div class="flex items-center justify-end" v-if="shouldDisplayInfo">
        <span class="text-gray-primary text-[.813rem]">{{ sentAt }}</span>
        <span class="text-soft font-bold ml-[.375rem]">{{ owner.username }}</span>
      </div>
      <div class="flex items-center">
        <div
          :class="
            shouldDisplayInfo
              ? `rounded-tl-2xl rounded-br-2xl rounded-bl-2xl w-fit bg-primary px-4 py-[.75rem]`
              : 'rounded-2xl  w-fit bg-primary px-4 py-[.75rem] mt-2'
          "
        >
          <p v-if="type === 'TEXT'" class="text-soft">{{ content }}</p>
          <div v-else class="max-w-64">
            <img class="rounded-lg" :src="content" alt="" />
          </div>
        </div>
      </div>
    </div>
    <div class="w-[2.125rem] h-[2.125rem] ml-[.688rem]">
      <img v-show="shouldDisplayInfo" :src="owner.avatarUrl" alt="" />
    </div>
  </div>
</template>

<style scoped></style>
