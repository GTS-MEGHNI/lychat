<script setup lang="ts">
defineProps({
  content: null
})
</script>

<template>
  <div>
    <img class="rounded-lg" :src="content" alt="" />
  </div>
</template>

<style scoped>

</style>