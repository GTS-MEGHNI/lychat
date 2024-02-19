import type { ComponentInternalInstance } from 'vue'

export class ContentEditableUtil {

  static LINE_BREAK: string = '<p><br /></p>'

  static insertPastedContentAsText(event: ClipboardEvent) {
    event.preventDefault()
    const content = event.clipboardData?.getData('text/plain')
    document.execCommand('insertText', false, content)
  }

  static insertNewLine(instance: ComponentInternalInstance) {
    const elem: HTMLDivElement = instance.refs.editableDiv as HTMLDivElement;
    (instance.refs.editableDiv as HTMLDivElement).innerHTML += this.LINE_BREAK
    const range = document.createRange()
    range.selectNodeContents(elem)
    range.collapse(false)
    const selection = window.getSelection()
    selection?.removeAllRanges()
    selection?.addRange(range)
  }

  static validTextContent(content: string): boolean {
    const regex: RegExp = new RegExp('^\\n+$')
    return content.length > 0 && !regex.test(content)
  }

  static resetContent(instance: ComponentInternalInstance) {
    (instance.refs.editableDiv as HTMLDivElement).innerText = ''
  }
}