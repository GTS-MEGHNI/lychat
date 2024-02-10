<script setup lang="ts">
defineProps({
  content: null
})
</script>

<template>
  <div class="max-w-64">
    <img class="rounded-lg" :src="content" alt="" />
  </div>
</template>

<style scoped>

</style>