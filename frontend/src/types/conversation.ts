export type ContentType = 'IMAGE' | 'TEXT'

export interface Participant {
  id: number | string
  username: string
  avatarUrl: string
}

export interface ConversationMessage {
  id: number | string
  type: ContentType
  content: string
  owner: Participant
  sentAt: string
}

export interface Conversation {
  id: number | string
  participants: Array<Participant>
  latestMessage: ConversationMessage
  unreadMessagesCount: number
  createdAt: Date
  avatarUrl: string
  isGroup: boolean
  isMuted: boolean
  isPinned: boolean
  isArchived: boolean
}
