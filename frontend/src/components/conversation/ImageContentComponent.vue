<script setup lang="ts">
defineProps({
  content: null
})
</script>

<template>
  <div class="max-w-72 rounded-xl w-fit bg-primary text-soft px-2 py-[.4rem] mt-2">
    <img class="rounded-lg" :src="content" alt="" />
  </div>
</template>

<style scoped>

</style>