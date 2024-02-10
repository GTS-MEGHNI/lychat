import { type DraftMessage, MessageSenderService } from '@/services/MessageSenderService'

export class FileSenderService {

  /*static supportedTypes = ['jpeg', 'jpg', 'png', 'txt']*/

  static handleFile(file: File) {
    const reader: FileReader = new FileReader()
    reader.readAsDataURL(file)
    const fileType: string = this.getFileType(file.type)
    reader.onload = () => {
      const base64EncodedString: string = FileSenderService.getBase64EncodedStringFrom(reader.result as string)
      if (fileType === 'image')
        MessageSenderService.send(({
          'content': base64EncodedString,
          'type': 'IMAGE',
          'originalReaderResult': reader.result as string
        } as DraftMessage)).then()
      else if (fileType === 'text') {
        MessageSenderService.send({
          'content': base64EncodedString,
          'type': 'FILE',
          'originalReaderResult': reader.result as string,
          'fileName': file.name,
          'fileSizeInBytes': file.size
        }).then()
      }
    }
  }

  static getBase64EncodedStringFrom(result: string): string {
    const regex: RegExp = new RegExp(/^data:.*?\/\w+;base64,(.*)$/)
    return (result.match(regex) as Array<string>)[1]
  }

  static getFileType(fileType: string): string {
    return (fileType.split('/')[0])
  }
}