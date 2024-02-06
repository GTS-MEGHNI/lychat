<script setup lang="ts">

import { defineProps } from 'vue';

defineProps<{
  placeholder: string,
  iconPosition: 'START' | 'END'
}>()

</script>

<template>
  <div
      class="rounded-[.438rem] px-[1.063rem] py-[.813rem] flex items-center justify-between bg-dark-secondary w-[18.125rem]"
  >
    <button v-if="iconPosition === 'START'">
      <img src="../assets/icons/loop.svg" alt=""/>
    </button>
    <input
        class="w-full bg-transparent outline-none ml-[.813rem]"
        type="text"
        placeholder="Search anything"
    />
    <button v-if="iconPosition === 'END'" class="mr-[1.312rem]">
      <img src="../assets/icons/loop.svg" alt=""/>
    </button>
  </div>
</template>

<style scoped>

</style>