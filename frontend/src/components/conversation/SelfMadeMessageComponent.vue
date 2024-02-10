<script setup lang="ts">
import type { ConversationMessage, FileMetaData } from '@/types/conversation'
import TextContentComponent from '@/components/conversation/TextContentComponent.vue'
import ImageContentComponent from '@/components/conversation/ImageContentComponent.vue'
import FileContentComponent from '@/components/conversation/FileContentComponent.vue'

interface AdditionProps {
  shouldDisplayInfo: boolean
}

defineProps<ConversationMessage & AdditionProps>()
</script>

<template>
  <div class="w-full flex justify-end">
    <div class="mr-2">
      <div class="flex items-center justify-end" v-if="shouldDisplayInfo">
        <span class="text-gray-primary text-[.813rem]">{{ sentAt }}</span>
        <span class="text-soft font-bold ml-[.375rem]">{{ owner.username }}</span>
      </div>
      <div class="text-soft flex items-center justify-end">
        <div class="w-fit bg-primary px-4 py-[.75rem]"
             :class="shouldDisplayInfo ? `rounded-tl-2xl rounded-br-2xl rounded-bl-2xl`
              : 'rounded-2xl mt-2'">
          <TextContentComponent v-if="type === 'TEXT'" :content="content" />
          <ImageContentComponent v-else-if="type === 'IMAGE'" :content="content" />
          <FileContentComponent v-else
                                :name="(content as FileMetaData).name"
                                :size="(content as FileMetaData).size" />
        </div>
      </div>
    </div>
    <div class="w-[2.125rem] h-[2.125rem] ml-[.688rem]">
      <img v-show="shouldDisplayInfo" :src="owner.avatarUrl" alt="" />
    </div>
  </div>
</template>

<style scoped></style>
