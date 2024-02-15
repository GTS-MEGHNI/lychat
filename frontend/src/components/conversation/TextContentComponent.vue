<script setup lang="ts">

defineProps({
  content: null
})

</script>

<template>
  <div class="max-w-xl rounded-2xl w-fit bg-primary text-soft px-4 py-[.75rem] mt-2">
    <p style="white-space: pre-line">{{ content }}</p>
  </div>
</template>

<style scoped>

</style>