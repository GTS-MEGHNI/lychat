import axios from 'axios'
import store from '@/store'
import type { Discussion } from '@/types/Discussion'

export class ConversationsService {

  private static userId: number = store.getters.getUserId

  static async fetchConversations(): Promise<void> {
    return axios.get(`http://127.0.0.1:8000/api/users/${this.userId}/conversations`).then((response) => {
      store.dispatch('conversationsFetched', response.data).then()
      this.loadConversation(response.data[0].id as number)
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
}
