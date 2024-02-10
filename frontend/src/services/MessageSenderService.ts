import type { ContentType, ConversationMessage, FileMetaData } from '@/types/conversation'
import store from '@/store'
import axios from 'axios'
import type { Discussion } from '@/types/Discussion'
import { uuid } from 'vue-uuid'

export interface DraftMessage {
  content: string,
  type: ContentType,
  originalReaderResult?: string
  fileName?: string,
  fileSizeInBytes?: number
}

export class MessageSenderService {
  static reshapedMessage: ConversationMessage

  static async send(message: DraftMessage) {
    this.reshapedMessage = this.reshapeMessage(message)
    await store.dispatch('messageCreated', this.reshapedMessage)
    this.playSendSound()
    await this.sendMessageToApi(message)
  }

  static async sendMessageToApi(message: DraftMessage) {
    const userId = store.getters.getUserId
    const conversationId = (store.getters.getCurrentDiscussion as Discussion).id

    const payload: ConversationMessage = { ...this.reshapedMessage }
    if (payload.type === 'IMAGE') {
      payload.content = message.content
    }

    const response = await axios.post(`http://localhost:8000/api/users/${userId}/conversations/${conversationId}/messages`, payload)
    const apiResponse = response.data
    await store.dispatch('messageStored', { ...apiResponse, oldId: this.reshapedMessage.id })
  }

  static reshapeMessage(message: DraftMessage): ConversationMessage {
    let content: string | FileMetaData
    switch (message.type) {
      case 'TEXT':
        content = message.content as string
        break
      case 'IMAGE':
        content = message.originalReaderResult as string
        break
      default:
        content = {
          name: message.fileName,
          size: message.fileSizeInBytes,
          base64: message.content
        } as FileMetaData
    }
    return {
      id: uuid.v4(),
      type: message.type,
      content: content,
      owner: store.getters.getUser,
      sentAt: this.getSentAtValue(),
      isCurrentUserMessage: true
    }
  }

  static playSendSound() {
    const audio = new Audio('src/assets/sound/send-message-sound.mp3')
    audio.play().then()
  }

  static getSentAtValue(): string {
    const currentDate = new Date()
    return currentDate.toLocaleTimeString('en-US', { hour12: true }).replace(/:\d+ /, ' ')
  }
}
