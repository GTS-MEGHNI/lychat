<script setup lang="ts">
defineProps({
  content: null,
  backgroundColor: null
})

</script>

<template>
  <div>
    <audio controls>
      <source :src="content" type="audio/ogg">
    </audio>
  </div>
</template>

<style scoped>

</style>