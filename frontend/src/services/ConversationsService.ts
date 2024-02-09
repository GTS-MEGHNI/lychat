import axios from 'axios'
import store from '@/store'
import type { Discussion } from '@/types/Discussion'
import type { Conversation, ReceivedConversationMessage } from '@/types/conversation'
import Pusher, { Channel } from 'pusher-js'

export class ConversationsService {
  private static userId: number = store.getters.getUserId

  static async fetchConversations(): Promise<void> {
    return axios.get(`http://127.0.0.1:8000/api/users/${this.userId}/conversations`).then((response) => {
      store.dispatch('conversationsFetched', response.data as Conversation[]).then()
      this.loadConversation(response.data[0].id as number)
      this.listenToPusherEvents(response.data as Conversation[])
    })
  }

  static async loadConversation(conversationId: number): Promise<void> {
    if ((store.getters.getCurrentDiscussion as Discussion).id !== conversationId) {
      return axios.get(`http://127.0.0.1:8000/api/users/${this.userId}/conversations/${conversationId}`)
        .then((response) => {
          store.dispatch('conversationFetched', response.data).then()
        })
    }
  }
  static listenToPusherEvents(conversations: Conversation[]) {
    const pusher: Pusher = new Pusher('65f9ba7832efbb72c75e', {
      cluster: 'eu'
    })
    conversations.forEach(function(conversation: Conversation) {
      const channel: Channel = pusher.subscribe(`conversation-${conversation.id}`)
      channel.bind('message-created', function(data: ReceivedConversationMessage) {
        console.log(data.conversationMessage.owner.id !== store.getters.getUserId)
        if (data.conversationMessage.owner.id !== store.getters.getUserId) {
          data.conversationMessage.isCurrentUserMessage = false
          store.dispatch('messageReceived', data).then()
        }
      })
    })
  }
}
