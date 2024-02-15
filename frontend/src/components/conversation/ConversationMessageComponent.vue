<script setup lang="ts">
import type { ConversationMessage, FileMetaData } from '@/types/conversation'
import FileContentComponent from '@/components/conversation/FileContentComponent.vue'
import TextContentComponent from '@/components/conversation/TextContentComponent.vue'
import ImageContentComponent from '@/components/conversation/ImageContentComponent.vue'

interface AdditionProps {
  shouldDisplayInfo: boolean
}

defineProps<ConversationMessage & AdditionProps>()
</script>

<template>
  <div class="w-full flex">
    <div class="w-[2.125rem] h-[2.125rem] mr-[.688rem]">
      <img v-show="shouldDisplayInfo" :src="owner.avatarUrl" alt="" />
    </div>
    <div>
      <div v-if="shouldDisplayInfo">
        <span class="text-soft font-bold mr-[1.875rem]">{{ owner.username }}</span>
        <span class="text-gray-primary text-[.813rem]">{{ sentAt }}</span>
      </div>
      <TextContentComponent backgroundColor="dark-primary"
                            v-if="type === 'TEXT'"
                            :content="content" />
      <ImageContentComponent v-else-if="type === 'IMAGE'"
                             backgroundColor="dark-primary"
                             :content="content" />
      <FileContentComponent v-else
                            :name="(content as FileMetaData).name"
                            :size="(content as FileMetaData).size"
                            :url="(content as FileMetaData).url" />
    </div>
  </div>
</template>

<style scoped></style>
