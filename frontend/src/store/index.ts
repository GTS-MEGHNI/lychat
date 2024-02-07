import { createStore } from 'vuex'
import type { RootState } from '@/types/state'
import type { Message } from '@/types/message'

export default createStore<RootState>({
  state: {
    messages: [
      {
        id: 1,
        avatarUrl: 'src/assets/pictures/avatar-1.png',
        fullName: 'Killian James',
        contentType: 'TEXT',
        content: 'Hello everyone !',
        sentAt: '04:30 AM'
      },
      {
        id: 2,
        avatarUrl: 'src/assets/pictures/avatar-2.png',
        fullName: 'Emily Johnson',
        contentType: 'TEXT',
        content: 'Hello everyone !',
        sentAt: '04:30 AM'
      },
      {
        id: 3,
        avatarUrl: 'src/assets/pictures/avatar-3.png',
        fullName: 'Sophia Rodriguez',
        contentType: 'TEXT',
        content: 'Hello everyone !',
        sentAt: '04:30 AM'
      },
      {
        id: 4,
        avatarUrl: 'src/assets/pictures/avatar-4.png',
        fullName: 'Olivia Smith',
        contentType: 'TEXT',
        content: 'Hello everyone !',
        sentAt: '04:30 AM'
      },
      {
        id: 5,
        avatarUrl: 'src/assets/pictures/avatar-5.png',
        fullName: 'Benjamin Williams',
        contentType: 'TEXT',
        content: 'Hello everyone !',
        sentAt: '04:30 AM'
      }
    ]
  },
  getters: {
    getMessages: (state: RootState): Array<Message> => state.messages
  },
  mutations: {},
  actions: {},
  modules: {}
})
