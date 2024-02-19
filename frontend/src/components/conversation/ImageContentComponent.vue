<script setup lang="ts">
defineProps({
  content: null,
  backgroundColor: null
})
</script>

<template>
  <div :class="['max-w-72', 'rounded-xl', 'w-fit', `bg-${backgroundColor}`, 'text-soft', 'px-2', 'py-[.4rem]']">
    <img class="rounded-lg" :src="content" alt="" />
  </div>
</template>

<style scoped>

</style>