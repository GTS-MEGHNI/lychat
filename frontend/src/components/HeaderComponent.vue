<script setup lang="ts">
</script>

<template>
  <div
    class="relative flex items-center justify-center text-white bg-dark-primary h-[4.75rem]"
  >
    <div class="flex items-center justify-center w-full">
      <div
        class="rounded-[.438rem] py-[.813rem] flex items-center justify-between bg-dark-secondary w-[18.125rem]"
      >
        <input
          class="w-full bg-transparent outline-none ml-[.813rem]"
          type="text"
          placeholder="Search anything"
        />
        <button class="mr-[1.312rem]">
          <img src="../assets/icons/loop.svg" alt="" />
        </button>
      </div>
    </div>
    <div class="flex items-center mr-[4.125rem]">
      <div class="relative mr-[1.875rem] min-w-[1.5rem] min-h[1.5rem]">
        <div class="bg-primary right-0 rounded-full px-[.188rem] text-[.5rem] absolute">2</div>
        <button>
          <img class="w-[2rem]" src="../assets/icons/notification.svg" alt="" />
        </button>
      </div>
      <div class="min-w-[2.5rem] min-h-[2.5rem]">
        <div class="overflow-hidden bg-primary rounded-full w-[2.5rem] h-[2.5rem]">
          <img src="../assets/pictures/me.png" alt="" />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
