<script setup lang="ts">
import { getCurrentInstance, onMounted, ref } from 'vue'
import { FileSenderService } from '@/services/FileSenderService'
import { MessageSenderService } from '@/services/MessageSenderService'
import { ContentEditableUtil } from '@/utils/content-editable.util'
import { ContentType } from '@/types/conversation'

let input = ref<string>('')
let editableDiv = ref<HTMLDivElement>()
let instance: ReturnType<typeof getCurrentInstance> = null

onMounted(() => {
  instance = getCurrentInstance()
})

function emitMessageSentEvent() {
  setTimeout(() => instance !== null ? instance.emit('messageSent') : {}, 100);
}

function sendTextMessage(event: KeyboardEvent) {
  event.preventDefault()
  if (ContentEditableUtil.validTextContent(input.value) && instance !== null) {
    MessageSenderService.send({ content: input.value, type: ContentType.Text })
    emitMessageSentEvent()
    ContentEditableUtil.resetContent(instance)
    input.value = ''
  }
}


function openFilePicker() {
  const filePicker: HTMLInputElement = (instance?.refs.filePicker as HTMLInputElement)
  filePicker.click()
}

function handleFilePicked(event: Event) {
  const target = (event.target as HTMLInputElement)
  if (target && target.files) {
    const file: File = target.files[0]
    if (file) {
      FileSenderService.sendFile(file)
      emitMessageSentEvent()
    }
  }
}

function updateContent() {
  instance !== null ? input.value = ((instance.refs.editableDiv as HTMLDivElement).innerText) : {}
}

function handleContentPaste(event: ClipboardEvent) {
  ContentEditableUtil.insertPastedContentAsText(event)
}

function insertNewLine(event: KeyboardEvent) {
  event.preventDefault()
  instance !== null ? ContentEditableUtil.insertNewLine(instance) : ''
}

</script>

<template>
  <div class="flex items-center bg-dark-type py-[1.188rem] px-4">
    <div>
      <div>
        <button @click="openFilePicker">
          <img src="../../assets/icons/gallery.svg" alt="" />
          <input @change="handleFilePicked" ref="filePicker" type="file" style="display: none" />
        </button>
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
           tabindex="0"
           @keydown.enter.exact="sendTextMessage"
           @keydown.ctrl.enter="insertNewLine">
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