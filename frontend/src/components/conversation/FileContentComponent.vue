<script setup lang="ts">
import type { FileMetaData } from '@/types/conversation'

const props = defineProps<FileMetaData>()

function downloadFile() {
  window.open(props.url)
}
</script>

<template>
  <div class="flex items-center gap-2 rounded-xl w-fit bg-dark-type text-soft px-2 py-[.4rem] mt-2">
    <div class="w-6 ml-2">
      <button class="" @click="downloadFile"><img src="../../assets/icons/file.svg" alt=""></button>
    </div>
    <div>
      <p class="text-sm">{{ name }}</p>
      <p class="text-gray-primary text-sm">{{ size }} B</p>
    </div>
  </div>
</template>

<style scoped>

</style>