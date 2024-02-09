import type { Conversation, ConversationMessage } from '@/types/conversation'

export interface Discussion extends Conversation {
  messages: Array<ConversationMessage>
  title: string
}
