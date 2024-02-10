<script setup lang="ts">
import type { FileMetaData } from '@/types/conversation'

defineProps<FileMetaData>()
</script>

<template>
  <div class="flex items-center gap-2">
    <div class="w-8">
      <button @click=""><img src="../../assets/icons/file.svg" alt=""></button>
    </div>
    <div>
      <p>{{name}}</p>
      <p>{{size}} B</p>
    </div>
  </div>
</template>

<style scoped>

</style>