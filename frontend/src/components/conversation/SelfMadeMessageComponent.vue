<script setup lang="ts">
import type { ConversationMessage, FileMetaData } from '@/types/conversation'
import TextContentComponent from '@/components/conversation/TextContentComponent.vue'
import ImageContentComponent from '@/components/conversation/ImageContentComponent.vue'
import FileContentComponent from '@/components/conversation/FileContentComponent.vue'
import AudioContentComponent from '@/components/conversation/AudioContentComponent.vue'

interface AdditionProps {
  shouldDisplayInfo: boolean
}

defineProps<ConversationMessage & AdditionProps>()
</script>

<template>
  <div class="w-full flex justify-end">
    <div class="flex flex-col items-end">
      <div class="flex items-center justify-end" v-if="shouldDisplayInfo">
        <span class="text-gray-primary text-[.813rem]">{{ sentAt }}</span>
        <span class="text-soft font-bold ml-[.375rem]">{{ owner.username }}</span>
      </div>
      <TextContentComponent v-if="type === 'TEXT'"
                            backgroundColor="primary"
                            :content="content" />
      <ImageContentComponent v-else-if="type === 'IMAGE'"
                             backgroundColor="primary"
                             :content="content" />
      <FileContentComponent v-else-if="type === 'FILE'"
                            :name="(content as FileMetaData).name"
                            :size="(content as FileMetaData).size"
                            :url="(content as FileMetaData).url" />

      <AudioContentComponent v-else
                             :content="(content as FileMetaData).url" />
    </div>
    <div class="w-[2.125rem] h-[2.125rem] ml-[.688rem]">
      <img v-show="shouldDisplayInfo" :src="owner.avatarUrl" alt="" />
    </div>
  </div>
</template>

<style scoped></style>
