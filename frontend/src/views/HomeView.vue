<script setup lang="ts">
import SideBarComponent from '@/components/SideBarComponent.vue'
import HeaderComponent from '@/components/HeaderComponent.vue'
import MessagesComponent from "@/components/MessagesComponent.vue";
</script>

<template>
  <SideBarComponent />
  <div class="h-full ml-[5.875rem] w-[calc(100%-5.875rem)]">
    <HeaderComponent />
    <MessagesComponent />
  </div>
</template>

<style scoped></style>
