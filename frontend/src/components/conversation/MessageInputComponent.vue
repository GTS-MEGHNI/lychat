<script setup lang="ts">
import { getCurrentInstance, onMounted, ref } from 'vue'
import { MessageSenderService } from '@/services/MessageSenderService'

let input = ref<string>('')
let instance: ReturnType<typeof getCurrentInstance> = null
let imageUrl = ref<string>('')

onMounted(() => {
  instance = getCurrentInstance()
  window.addEventListener('keydown', handleKeyPress)
})

function sendMessage() {
  if (input.value !== '') {
    MessageSenderService.send({
      content: input.value,
      type: 'TEXT'
    })
    if (instance !== null) instance.emit('messageSent')
    input.value = ''
  }
}

function handleKeyPress(event: any) {
  if (event.keyCode === 13) sendMessage()
}

function openFilePicker() {
  (instance?.refs.filePicker as HTMLInputElement).click()
}

function handleImagePicked(event: Event) {
  const target = (event.target as HTMLInputElement)
  if (target && target.files) {
    const file: File = target.files[0]
    if (file) {
      const reader: FileReader = new FileReader()
      reader.readAsDataURL(file)
      reader.onload = () => {
         MessageSenderService.send({
          content: reader.result as string,
          type: 'IMAGE'
        })
      }
    }
  }
}


</script>

<template>
  <div class="justify-center items-center flex bg-dark-type py-[1.188rem]">
    <div class="gap-4 w-full mx-[2.25rem] rounded-[1.563rem] justify-between bg-dark-primary flex flex-col py-4 px-[1.5rem]">
<!--      <div class="max-w-16">-->
<!--        <img src="../../assets/pictures/avatar-6.png" alt="">-->
<!--      </div>-->
      <div class="flex w-full">
        <div class="flex grow mr-5">
          <div>
            <img src="../../assets/icons/microphone.svg" alt="" />
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
            <button @click="openFilePicker"><img src="../../assets/icons/gallery.svg" alt="" /></button>
          </div>
          <div>
            <img src="../../assets/icons/emojis.svg" alt="" />
          </div>
          <div>
            <button @click="sendMessage">
              <input @change="handleImagePicked" ref="filePicker" type="file" style="display: none" />
              <img src="../../assets/icons/send.svg" alt="" />
            </button>
          </div>
          <div>
            <img src="../../assets/icons/location.svg" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
