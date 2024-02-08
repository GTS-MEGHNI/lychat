import axios from 'axios'
import store from '@/store'

export class ConversationsService {
  static async fetchConversations(): Promise<void> {
    return axios.get('http://127.0.0.1:8000/api/users/1/conversations').then((response) => {
      store.dispatch('conversationsFetched', response.data).then()
    })
  }

  static async loadConversation(conversationId: number): Promise<void> {
    console.log(conversationId)
  }
}
