<script setup lang="ts">
import { defineProps } from 'vue'

defineProps<{
  avatarUrl: string
  fullName: string
}>()
</script>

<template>
  <div class="flex items-center">
    <div class="rounded-full overflow-hidden min-w-[50px] min-h-[50px]">
      <img class="w-[50px] h-[50px]" :src="avatarUrl" alt="" />
    </div>
    <div class="flex justify-between w-full">
      <div class="flex flex-col ml-[.938rem]">
        <span class="text-soft font-bold">{{ fullName }}</span>
        <!--        <span class="text-sm text-green">Typing...</span>-->
        <span class="text-gray-primary text-sm">Hello everyone !</span>
      </div>
      <div class="flex flex-col items-end">
        <span class="text-gray-primary text-[.813rem]">4:30 PM</span>
        <span
          class="flex items-center justify-center bg-primary rounded-full w-4 h-4 text-xs font-bold"
          >2</span
        >
      </div>
    </div>
  </div>
</template>

<style scoped></style>
