<script setup lang="ts">
import SideBarComponent from '@/components/SideBarComponent.vue'
import MessagesComponent from '@/components/MessagesComponent.vue'
import ConversationComponent from '@/components/conversation/ConversationComponent.vue'
import MessageInputComponent from '@/components/MessageInputComponent.vue'
</script>

<template>
  <SideBarComponent />
  <div class="h-full ml-[5.875rem] w-[calc(100%-5.875rem)]">
    <div class="flex h-full">
      <MessagesComponent />
      <div class="flex flex-col w-full justify-between">
        <ConversationComponent />
        <MessageInputComponent />
      </div>
    </div>
  </div>
</template>

<style scoped></style>
