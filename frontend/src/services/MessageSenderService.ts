import type { ConversationMessage } from '@/types/conversation'
import store from '@/store'
import axios from 'axios'
import type { Discussion } from '@/types/Discussion'
import { uuid } from 'vue-uuid'

export class MessageSenderService {
  static reshapedMessage: ConversationMessage

  static send(content: string) {
    this.reshapedMessage = this.reshapeMessage(content)
    store.dispatch('messageCreated', this.reshapedMessage).then(() => {
      this.playSendSound()
      this.sendMessageToApi()
    })
  }

  static sendMessageToApi() {
    const userId = store.getters.getUserId
    const conversationId = (store.getters.getCurrentDiscussion as Discussion).id
    axios
      .post(
        `http://localhost:8000/api/users/${userId}/conversations/${conversationId}/messages`,
        this.reshapedMessage
      )
      .then((response) => {
        const apiResponse = response.data
        store
          .dispatch('messageStored', {
            ...apiResponse,
            oldId: this.reshapedMessage.id
          })
          .then()
      })
  }

  static reshapeMessage(content: string): ConversationMessage {
    return {
      id: uuid.v4(),
      type: 'TEXT',
      content: content,
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
