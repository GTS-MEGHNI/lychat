import { createStore } from 'vuex'
import type { RootState } from '@/types/state'
import type { Conversation } from '@/types/conversation'

export default createStore<RootState>({
  state: {
    conversations: [
      {
        id: 1,
        participants: [
          {
            id: 1,
            username: 'Killian James',
            avatarUrl: 'src/assets/pictures/avatar-1.png'
          },
          {
            id: 1,
            username: 'Mohamed El Amine',
            avatarUrl: 'src/assets/pictures/avatar-1.png'
          }
        ],
        latestMessage: {
          id: 1,
          type: 'TEXT',
          content: 'This is a message',
          owner: {
            id: 1,
            username: 'Killian James',
            avatarUrl: 'src/assets/pictures/avatar-1.png'
          },
          sentAt: '04:30 PM'
        },
        unreadMessagesCount: 10,
        createdAt: new Date(),
        avatarUrl: 'src/assets/pictures/avatar-1.png',
        isGroup: false,
        isMuted: false,
        isPinned: false,
        isArchived: false
      }
    ]
  },
  getters: {
    getConversations: (state: RootState): Array<Conversation> => state.conversations
  },
  mutations: {},
  actions: {},
  modules: {}
})
