export type ContentType = 'IMAGE' | 'TEXT'

export interface Message {
  id: number | string
  avatarUrl: string
  fullName: string
  contentType: ContentType
  content: string
  sentAt: string
}
