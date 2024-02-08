import type { ConversationMessage } from '@/types/conversation'
import store from '@/store'

export class MessageSenderService {

  static send( content: string) {
    store.dispatch('messageCreated', this.reshapeMessage(content) as ConversationMessage)
  }


  static reshapeMessage(content:string): ConversationMessage {
    return {
      id: 9999,
      type: 'TEXT',
      content: content,
      owner: store.getters.getUser,
      sentAt: '04:00 PM',
      isCurrentUserMessage: true
    }
  }

}