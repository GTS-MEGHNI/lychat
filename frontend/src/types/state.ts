import type { Conversation } from '@/types/conversation'
import type { Discussion } from '@/types/Discussion'
export interface RootState {
  conversations: Array<Conversation>
  currentDiscussion: Discussion | null
}
