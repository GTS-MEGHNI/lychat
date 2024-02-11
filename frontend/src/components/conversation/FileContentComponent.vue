<script setup lang="ts">
import type { FileMetaData } from '@/types/conversation'

const props = defineProps<FileMetaData>()

function downloadFile() {
  window.open(props.url)
}
</script>

<template>
  <div class="flex items-center gap-2">
    <div class="w-6">
      <button @click="downloadFile"><img src="../../assets/icons/file.svg" alt=""></button>
    </div>
    <div>
      <p>{{ name }}</p>
      <p>{{ size }} B</p>
    </div>
  </div>
</template>

<style scoped>

</style>