<script setup lang="ts">
import SearchInputComponent from '@/components/SearchInputComponent.vue'
import MessageComponent from '@/components/MessageComponent.vue'
import { onMounted, ref } from 'vue'
import { useStore } from 'vuex'
import type { Message } from '@/types/message'

let store = null
let messages = ref<Array<Message>>([])

onMounted(() => {
  store = useStore()
  messages.value = store.getters.getMessages
})
</script>

<template>
  <div
    class="overflow-y-scroll overflow-x-hidden px-[1.875rem] h-full bg-dark-accent text-white w-[400px]"
  >
    <div class="mb-[1.563rem]">
      <h1 class="text-3xl font-bold pt-[1.813rem]">Messages</h1>
    </div>
    <div class="mb-[2.5rem]">
      <SearchInputComponent placeholder="search" iconPosition="START" />
    </div>
    <div class="flex flex-col gap-[1.875rem]">
      <div v-for="(message, index) in messages" :key="index">
        <MessageComponent :avatarUrl="message.avatarUrl" :fullName="message.fullName" />
      </div>
    </div>
  </div>
</template>

<style scoped></style>
