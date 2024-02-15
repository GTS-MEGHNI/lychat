<script setup lang="ts">
import { getCurrentInstance, onMounted, ref } from 'vue'
import { FileSenderService } from '@/services/FileSenderService'
import { MessageSenderService } from '@/services/MessageSenderService'

let input = ref<string>('')
let editableDiv = ref<HTMLDivElement>()
let instance: ReturnType<typeof getCurrentInstance> = null

onMounted(() => {
  instance = getCurrentInstance()
})

function sendMessage() {
  if (input.value !== '') {
    MessageSenderService.send({ content: input.value, type: 'TEXT' })
    setTimeout(function() {
      if (instance !== null) instance.emit('messageSent')
    }, 100)
    if (instance !== null) {
      (instance.refs.editableDiv as HTMLDivElement).innerText = ''
      input.value = ''
    }
  }
}

function openFilePicker() {
  const filePicker: HTMLInputElement = (instance?.refs.filePicker as HTMLInputElement)
  filePicker.click()
}

function handleImagePicked(event: Event) {
  const target = (event.target as HTMLInputElement)
  if (target && target.files) {
    const file: File = target.files[0]
    if (file) {
      FileSenderService.handleFile(file)
      setTimeout(function() {
        if (instance !== null) instance.emit('messageSent')
      }, 100)
    }
  }
}

function updateContent() {
  if (instance !== null)
    input.value = ((instance.refs.editableDiv as HTMLDivElement).innerText)
}

function handleContentPaste(event: any) {
  event.preventDefault()
  const content = event.clipboardData.getData('text/plain')
  document.execCommand('insertText', false, content)
}

</script>

<template>
  <div class="flex items-center bg-dark-type py-[1.188rem] px-4">
    <div>
      <div>
        <button @click="openFilePicker"><img src="../../assets/icons/gallery.svg" alt="" /></button>
      </div>
    </div>
    <div class="max-h-32 overflow-y-auto w-full mx-2 rounded-[1.563rem] bg-dark-primary py-4 px-[1.5rem]">
      <div ref="editableDiv"
           @input="updateContent"
           @paste="handleContentPaste"
           class="text-soft outline-none"
           contenteditable="true"
           role="textbox"
           spellcheck="true"
           tabindex="0">
      </div>
    </div>
    <div class="flex gap-2">
      <div>
        <button @click="sendMessage">
          <input @change="handleImagePicked" ref="filePicker" type="file" style="display: none" />
          <img src="../../assets/icons/send.svg" alt="" />
        </button>
      </div>

    </div>
  </div>
</template>

<style scoped></style>
<!--            <input-->
<!--              class="w-full bg-transparent outline-none text-soft"-->
<!--              type="text"-->
<!--              placeholder="Aa"-->
<!--              v-model="input"-->
<!--            />-->

<!--      <div>-->
<!--        <img src="../../assets/icons/emojis.svg" alt="" />-->
<!--      </div>-->
<!--      <div>-->
<!--        <img src="../../assets/icons/location.svg" alt="" />-->
<!--      </div>-->
<!--      <div>-->
<!--        <img src="../../assets/icons/microphone.svg" alt="" />-->
<!--      </div>-->