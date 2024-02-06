<script setup lang="ts">
defineProps<{
  shouldDisplayInfo: boolean
  content: string
}>()
</script>

<template>
  <div class="w-full flex justify-end">
    <div class="mr-2">
      <div class="flex items-center justify-end" v-if="shouldDisplayInfo">
        <span class="text-gray-primary text-[.813rem]">10:12 AM</span>
        <span class="text-soft font-bold ml-[.375rem]">Olivia Smith</span>
      </div>
      <div class="flex items-center">
        <div
          :class="
            shouldDisplayInfo
              ? `rounded-tl-2xl rounded-br-2xl rounded-bl-2xl w-fit bg-dark-primary px-4 py-[.75rem]`
              : 'rounded-2xl  w-fit bg-dark-primary px-4 py-[.75rem] mt-2'
          "
        >
          <p class="text-gray-secondary">{{ content }}</p>
        </div>
      </div>
    </div>
    <div class="w-[2.125rem] h-[2.125rem] ml-[.688rem]">
      <img v-show="shouldDisplayInfo" src="../../assets/pictures/avatar-2.png" alt="" />
    </div>
  </div>
</template>

<style scoped></style>
