import type { Conversation, Participant } from '@/types/conversation'
import type { Discussion } from '@/types/Discussion'
export interface RootState {
  user: Participant | {}
  conversations: Array<Conversation>
  currentDiscussion: Discussion | {}
}
