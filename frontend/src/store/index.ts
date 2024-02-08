import { ActionContext, createStore } from 'vuex'
import type { RootState } from '@/types/state'
import type { Conversation } from '@/types/conversation'
import type { Discussion } from '@/types/Discussion'

export default createStore<RootState>({
  state: {
    user: {
      id: 1,
      username: 'Mohamed El Amine',
      avatarUrl: 'src/assets/pictures/avatar-4.png'
    },
    currentDiscussion: {},
    conversations: []
  },
  getters: {
    getConversations: (state: RootState): Array<Conversation> => state.conversations,
    getCurrentDiscussion: (state: RootState): Discussion|{} => state.currentDiscussion,
    getUserId: (state: RootState) => state.user.id
  },
  mutations: {
    setConversations: (state: RootState, payload: Array<Conversation>) =>
      (state.conversations = payload),
    setCurrentDiscussion: (state: RootState, payload: Discussion) => state.currentDiscussion = payload
  },
  actions: {
    conversationsFetched: (
      state: ActionContext<RootState, RootState>,
      payload: Array<Conversation>
    ) => {
      state.commit('setConversations', payload)
    },
    conversationFetched: (
      state: ActionContext<RootState, RootState>,
      payload: Discussion
    ) => {
      state.commit('setCurrentDiscussion', payload)
    },
  },
  modules: {}
})
