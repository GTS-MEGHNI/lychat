import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import withUUID from 'vue-uuid'

const app = createApp(App).use(store).use(withUUID).use(router)
app.mount('#app')
