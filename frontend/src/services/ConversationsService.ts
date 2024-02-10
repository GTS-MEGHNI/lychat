import axios from 'axios'
import store from '@/store'
import type { Discussion } from '@/types/Discussion'
import type { Conversation, ReceivedConversationMessage } from '@/types/conversation'
import Pusher, { Channel } from 'pusher-js'

export class ConversationsService {

  static async fetchConversations() {
    const userId: number | string = store.getters.getUserId
    const response = await axios.get(`http://127.0.0.1:8000/api/users/${userId}/conversations`)
    await store.dispatch('conversationsFetched', response.data as Conversation[])
    await this.loadConversation(response.data[0].id as number)
    //this.listenToPusherEvents(response.data as Conversation[])
  }

  static async loadConversation(conversationId: number) {
    const userId: number | string = store.getters.getUserId
    const response = await axios.get(`http://127.0.0.1:8000/api/users/${userId}/conversations/${conversationId}`)
    await store.dispatch('conversationFetched', response.data)

  }

  static listenToPusherEvents(conversations: Conversation[]) {
    const pusher: Pusher = new Pusher('65f9ba7832efbb72c75e', {
      cluster: 'eu'
    })
    conversations.forEach(function(conversation: Conversation) {
      const channel: Channel = pusher.subscribe(`conversation-${conversation.id}`)
      channel.bind('message-created', function(data: ReceivedConversationMessage) {
        if (data.conversationMessage.owner.id !== store.getters.getUserId) {
          data.conversationMessage.isCurrentUserMessage = false
          store.dispatch('messageReceived', data).then()
        }
      })
    })
  }
}
