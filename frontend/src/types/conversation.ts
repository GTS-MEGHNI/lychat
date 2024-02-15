//export type ContentType = 'IMAGE' | 'TEXT' | 'FILE'
export type ConversationId = number | string

export enum ContentType {
  Image = 'IMAGE',
  Text = 'TEXT',
  File = 'FILE'
}

export interface Participant {
  id: number | string
  username: string
  avatarUrl: string
}

export interface FileMetaData {
  name: string,
  size: number,
  url?: string,
  base64?: string
}

export interface ConversationMessage {
  id: number | string
  type: ContentType
  content: string | FileMetaData
  owner: Participant
  sentAt: string
  isCurrentUserMessage: boolean
}

export interface DispatchedConversationMessage extends ConversationMessage {
  oldId: string
}

export interface ReceivedConversationMessage {
  conversationMessage: ConversationMessage
  conversationId: number
}

export interface Conversation {
  id: ConversationId
  participants: Array<Participant>
  latestMessage: ConversationMessage
  title: string
  isActive: boolean
  unreadMessagesCount: number
  avatarUrl: string
  isGroup: boolean
  isMuted: boolean
  isPinned: boolean
  isArchived: boolean
}
