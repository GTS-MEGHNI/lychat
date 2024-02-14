<script setup lang="ts">

defineProps({
  content: null
})

</script>

<template>
  <div class="rounded-2xl w-fit bg-primary text-soft px-4 py-[.75rem] mt-2">
    <p>{{ content }}</p>
  </div>
</template>

<style scoped>

</style>