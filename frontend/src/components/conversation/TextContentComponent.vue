<script setup lang="ts">

let props = defineProps({
  content: null,
  backgroundColor: null
})


</script>

<template>
  <div :class="['max-w-xl', 'rounded-2xl', 'w-fit', `bg-${backgroundColor}`, 'text-soft', 'px-4', 'py-[.75rem]']">
    <p style="white-space: pre-line">{{ content }}</p>
  </div>
</template>

<style scoped>

</style>