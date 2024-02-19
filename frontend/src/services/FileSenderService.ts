import { type DraftMessage, MessageSenderService } from '@/services/MessageSenderService'
import type { ContentType } from '@/types/conversation'

export class FileSenderService {

  static fileType: ContentType
  static base64EncodedString: string
  static fileReader: FileReader
  static file: File

  static sendFile(file: File) {
    this.file = file
    this.readFile(file).then(() => MessageSenderService.send(this.buildDraftMessage()).then())
  }

  static readFile(file: File) : Promise<void> {
    return new Promise<void>(resolve => {
      this.fileReader = new FileReader()
      this.fileReader.readAsDataURL(file)
      this.fileType = this.getFileType(file.type)
      this.fileReader.onload = () => {
        this.base64EncodedString = FileSenderService.getBase64EncodedStringFrom(this.fileReader.result as string)
        resolve()
      }
    })

  }

  static getBase64EncodedStringFrom(result: string): string {
    const regex: RegExp = new RegExp(/^data:.*?\/\w+;base64,(.*)$/)
    return (result.match(regex) as Array<string>)[1]
  }

  static getFileType(fileOriginalType: string): ContentType {
    switch (fileOriginalType.split('/')[0]) {
      case 'image':
        return <ContentType>'IMAGE'
      case 'audio':
        return <ContentType>'AUDIO'
      default:
        return <ContentType>'FILE'
    }
  }

  static buildDraftMessage() : DraftMessage {
    return {
      'content': this.base64EncodedString,
      'type': this.fileType,
      'originalReaderResult': this.fileReader.result as string,
      'fileName': this.file.name,
      'fileSizeInBytes': this.file.size
    }
  }

}