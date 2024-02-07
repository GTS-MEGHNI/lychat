<script setup lang="ts">
defineProps<{
  shouldDisplayInfo: boolean
  content: string
  contentType: 'image' | 'text'
}>()
</script>

<template>
  <div class="w-full flex">
    <div class="w-[2.125rem] h-[2.125rem] mr-[.688rem]">
      <img v-show="shouldDisplayInfo" src="../../assets/pictures/avatar-4.png" alt="" />
    </div>
    <div>
      <div v-if="shouldDisplayInfo">
        <span class="text-soft font-bold mr-[1.875rem]">Olivia Smith</span>
        <span class="text-gray-primary text-[.813rem]">10:12 AM</span>
      </div>
      <div class="flex items-center">
        <div
          :class="
            shouldDisplayInfo
              ? `rounded-tr-2xl rounded-br-2xl rounded-bl-2xl w-fit bg-dark-primary px-4 py-[.75rem]`
              : 'rounded-2xl  w-fit bg-dark-primary px-4 py-[.75rem] mt-2'
          "
        >
          <p v-if="contentType === 'text'" class="text-soft">{{ content }}</p>
          <div v-else class="max-w-64">
            <img class="rounded-lg" :src="content" alt="" />
          </div>
        </div>
        <div class="ml-[.75rem]">
          <button>
            <img src="../../assets/icons/conversation-message-actions-icon.svg" alt="" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
