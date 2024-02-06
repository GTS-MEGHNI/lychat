<script setup lang="ts">
import SearchInputComponent from '@/components/SearchInputComponent.vue'
import MessageComponent from '@/components/MessageComponent.vue'
</script>

<template>
  <div class="px-[1.875rem] h-full bg-dark-accent text-white w-fit">
    <div class="mb-[1.563rem]">
      <h1 class="text-3xl font-bold">Messages</h1>
    </div>
    <div class="mb-[2.5rem]">
      <SearchInputComponent placeholder="search" iconPosition="START" />
    </div>
    <div class="flex flex-col gap-[1.875rem]">
      <MessageComponent avatarUrl="src/assets/pictures/avatar-1.png" fullName="Killian James" />
      <MessageComponent avatarUrl="src/assets/pictures/avatar-2.png" fullName="Emily Johnson" />
      <MessageComponent avatarUrl="src/assets/pictures/avatar-3.png" fullName="Sophia Rodriguez" />
      <MessageComponent avatarUrl="src/assets/pictures/avatar-4.png" fullName="Olivia Smith" />
      <MessageComponent avatarUrl="src/assets/pictures/avatar-5.png" fullName="Benjamin Williams" />
    </div>
  </div>
</template>

<style scoped></style>
