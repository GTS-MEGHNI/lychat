<script setup lang="ts">

defineProps({
  avatarUrl: null,
  title: null
})

</script>

<template>
  <div class="bg-dark-primary flex items-center text-soft mb-[3.75rem] sticky top-0 py-4 pl-4">
    <div class="w-[3.75rem] sh-[3.75rem] mr-[1.125rem]">
      <img :src="avatarUrl" alt="" />
    </div>
    <div class="flex flex-col">
      <span class="text-3xl">{{ title }}</span>
      <span class="text-gray-primary text-sm">Active now</span>
    </div>
  </div>

</template>

<style scoped>

</style>