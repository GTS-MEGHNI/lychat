<script setup lang="ts">

</script>

<template>
  <div class="flex justify-center items-center w-6 h-6">
    <div class="spinner-circle w-6 h-6 rounded-full border-[.18rem] border-solid border-transparent border-t-white"></div>
  </div>
</template>

<style scoped>

.spinner-circle {
  animation: spinner-animation .6s linear infinite;
}

@keyframes spinner-animation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>