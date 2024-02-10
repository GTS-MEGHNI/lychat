import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import withUUID from 'vue-uuid'
import type { Participant } from '@/types/conversation'

const app = createApp(App).use(store).use(withUUID).use(router)
const initializeStore = () => {
  if (localStorage.getItem('user') !== null) {
    const user: Participant = JSON.parse(localStorage.getItem('user') as string)
    store.dispatch('userLoadedFromStorage', user).then()
  }
}
initializeStore()
app.mount('#app')
