import { ActionContext, createStore, MutationPayload } from 'vuex'
import type { RootState } from '@/types/state'
import type {
  Conversation, ConversationId,
  ConversationMessage,
  DispatchedConversationMessage,
  Participant,
  ReceivedConversationMessage
} from '@/types/conversation'
import type { Discussion } from '@/types/Discussion'


const store = createStore<RootState>({
  state: {
    user: {},
    currentDiscussion: {},
    conversations: []
  },
  getters: {
    getConversations: (state: RootState): Array<Conversation> => state.conversations,
    getCurrentDiscussion: (state: RootState): Discussion | {} => state.currentDiscussion,
    getUserId: (state: RootState): string | number => (state.user as Participant).id,
    getUser: (state: RootState): Participant => state.user as Participant
  },
  mutations: {
    initialize(state: RootState) {
      if (localStorage.getItem('user') !== null) {
        this.replaceState(
          Object.assign(state.user, JSON.parse(localStorage.getItem('user') as string))
        )
      }
    },

    setConversations: (state: RootState, payload: Array<Conversation>) =>
      (state.conversations = payload),

    setCurrentDiscussion: (state: RootState, payload: Discussion) =>
      (state.currentDiscussion = payload),

    appendMessageInCurrentDiscussion: (state: RootState, payload: ConversationMessage) =>
      (state.currentDiscussion as Discussion).messages.push(payload),

    updateMessageId: (state: RootState, payload: DispatchedConversationMessage) => {
      const messages: ConversationMessage[] = (state.currentDiscussion as Discussion).messages
      const index: number = messages.findIndex(
        (message: ConversationMessage) => message.id === payload.oldId
      )
      messages[index].id = payload.id
    },

    updateUserData: (state: RootState, payload: Participant) => {
      state.user = { ...payload }
    },

    updateConversationLatestMessage: (state: RootState, payload: ConversationMessage) => {
      const conversationId: ConversationId = (state.currentDiscussion as Discussion).id
      const index: number = state.conversations.findIndex(
        (conversation: Conversation) => conversation.id === conversationId
      )
      state.conversations[index].latestMessage = { ... payload}
    }

  },
  actions: {
    conversationsFetched: (
      state: ActionContext<RootState, RootState>,
      payload: Array<Conversation>
    ) => {
      state.commit('setConversations', payload)
    },

    conversationFetched: (state: ActionContext<RootState, RootState>, payload: Discussion) => {
      state.commit('setCurrentDiscussion', payload)
    },

    messageCreated: (state: ActionContext<RootState, RootState>, payload: ConversationMessage) => {
      state.commit('appendMessageInCurrentDiscussion', payload)
    },

    messageStored: (state: ActionContext<RootState, RootState>, payload: DispatchedConversationMessage) => {
      state.commit('updateMessageId', payload)
      state.commit('updateConversationLatestMessage', payload as ConversationMessage)
    },

    messageReceived: (
      state: ActionContext<RootState, RootState>,
      payload: ReceivedConversationMessage
    ) => {
      if (payload.conversationId === (state.getters.getCurrentDiscussion as Discussion).id) {
        state.commit('appendMessageInCurrentDiscussion', payload.conversationMessage)
      }
    },

    userLogged: (state: ActionContext<RootState, RootState>, payload: Participant) => {
      state.commit('updateUserData', payload)
    },

    userLoadedFromStorage: (state: ActionContext<RootState, RootState>, payload: Participant) =>
      state.commit('updateUserData', payload)
  },
  plugins:
    [],
  modules:
    {}
})

store.subscribe((mutation: MutationPayload, state: RootState) => {
  if (state.user !== undefined) {
    if (Object.keys(state.user).length !== 0) {
      localStorage.setItem('user', JSON.stringify(state.user))
      localStorage.getItem('user')
    }
  }
})

export default store
