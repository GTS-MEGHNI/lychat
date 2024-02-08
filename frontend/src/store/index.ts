import { ActionContext, createStore } from 'vuex'
import type { RootState } from '@/types/state'
import type { Conversation, ConversationMessage } from '@/types/conversation'

export default createStore<RootState>({
  state: {
    user: {
      id: 1,
      username: 'Maddison Herman',
      avatarUrl: 'src/assets/pictures/avatar-4.png'
    },
    currentDiscussion: {
      messages: [
        {
          id: 1,
          type: 'TEXT',
          content: 'This is a message',
          owner: {
            id: 1,
            username: 'Olivia Smith',
            avatarUrl: 'src/assets/pictures/avatar-4.png'
          },
          sentAt: '12:30 AM',
          isCurrentUserMessage: false
        },
        {
          id: 1,
          type: 'IMAGE',
          content:
            'https://wallpapersmug.com/download/2560x1440/c1284b/moraine-lake-banff-national-park.jpg',
          owner: {
            id: 1,
            username: 'Olivia Smith',
            avatarUrl: 'src/assets/pictures/avatar-4.png'
          },
          sentAt: '12:30 AM',
          isCurrentUserMessage: false
        },
        {
          id: 1,
          type: 'IMAGE',
          content:
            'https://wallpapersmug.com/download/2560x1440/c1284b/moraine-lake-banff-national-park.jpg',
          owner: {
            id: 999,
            username: 'Olivia Smith',
            avatarUrl: 'src/assets/pictures/avatar-4.png'
          },
          sentAt: '12:30 AM',
          isCurrentUserMessage: true
        }
      ]
    },
    conversations: []
  },
  getters: {
    getConversations: (state: RootState): Array<Conversation> => state.conversations,
    getDiscussionMessages: (state: RootState): Array<ConversationMessage> | [] =>
      state.currentDiscussion ? state.currentDiscussion.messages : []
  },
  mutations: {
    setConversations: (state: RootState, payload: Array<Conversation>) =>
      (state.conversations = payload)
  },
  actions: {
    conversationsFetched: (
      state: ActionContext<RootState, RootState>,
      payload: Array<Conversation>
    ) => {
      state.commit('setConversations', payload)
    }
  },
  modules: {}
})
