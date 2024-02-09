<script setup lang="ts">
import { getCurrentInstance, onMounted, ref } from 'vue'
import { Store, useStore } from 'vuex'
import { MessageSenderService } from '@/services/MessageSenderService'

let input = ref<string>('')
// eslint-disable-next-line @typescript-eslint/no-unused-vars
let store: Store<any>
let instance: ReturnType<typeof getCurrentInstance> = null

onMounted(() => {
  store = useStore()
  instance = getCurrentInstance()
  window.addEventListener('keydown', handleKeyPress)
})

function sendMessage() {
  if (input.value !== '') {
    MessageSenderService.send(input.value)
    if (instance !== null) instance.emit('messageSent')
    input.value = ''
  }
}

function handleKeyPress(event: any) {
  if (event.keyCode === 13) sendMessage()
}
</script>

<template>
  <div class="justify-center items-center flex bg-dark-type py-[1.188rem]">
    <div
      class="w-full mx-[2.25rem] rounded-[1.563rem] justify-between bg-dark-primary flex py-4 px-[1.5rem]"
    >
      <div class="flex grow mr-5">
        <div>
          <img src="../assets/icons/microphone.svg" alt="" />
        </div>
        <div class="w-full ml-[.938rem]">
          <input
            class="w-full bg-transparent outline-none text-soft"
            type="text"
            placeholder="Aa"
            v-model="input"
          />
        </div>
      </div>
      <div class="flex gap-[1.25rem]">
        <div>
          <img src="../assets/icons/gallery.svg" alt="" />
        </div>
        <div>
          <img src="../assets/icons/emojis.svg" alt="" />
        </div>
        <div>
          <button @click="sendMessage"><img src="../assets/icons/send.svg" alt="" /></button>
        </div>
        <div>
          <img src="../assets/icons/location.svg" alt="" />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
