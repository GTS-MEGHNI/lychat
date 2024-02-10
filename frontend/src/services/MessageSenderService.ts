import type { ContentType, ConversationMessage } from '@/types/conversation'
import store from '@/store'
import axios from 'axios'
import type { Discussion } from '@/types/Discussion'
import { uuid } from 'vue-uuid'

export class MessageSenderService {
  static reshapedMessage: ConversationMessage

  static send(message: { content: string, type: ContentType }) {
    this.reshapedMessage = this.reshapeMessage(message)
    store.dispatch('messageCreated', this.reshapedMessage).then(() => {
      this.playSendSound()
      this.sendMessageToApi()
    })
  }

  static sendMessageToApi() {
    const userId = store.getters.getUserId
    const conversationId = (store.getters.getCurrentDiscussion as Discussion).id
    const payload: ConversationMessage = { ...this.reshapedMessage }
    if (payload.type === 'IMAGE') {
      const regex: RegExp = new RegExp(/^data:image\/\w+;base64,(.*)$/)
      payload.content = (payload.content.match(regex) as Array<string>)[1]
    }
    axios.post(`http://localhost:8000/api/users/${userId}/conversations/${conversationId}/messages`, payload)
      .then((response) => {
        const apiResponse = response.data
        store.dispatch('messageStored', {
          ...apiResponse,
          oldId: this.reshapedMessage.id
        }).then()
      })
  }

  static reshapeMessage(message: { content: string, type: ContentType }): ConversationMessage {
    return {
      id: uuid.v4(),
      type: message.type,
      content: message.content,
      owner: store.getters.getUser,
      sentAt: '04:00 PM',
      isCurrentUserMessage: true
    }
  }

  static playSendSound() {
    const audio = new Audio('src/assets/sound/send-message-sound.mp3')
    audio.play().then()
  }
}
