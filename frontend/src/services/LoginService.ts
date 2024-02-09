import type { LoginData } from '@/types/user'
import axios from 'axios'
import store from '@/store'
import router from '@/router'

export class LoginService {

  static async login(data: LoginData) {
    const response = await axios.post('http://localhost:8000/api/auth/login', data)
    store.dispatch('userLogged', response.data).then(() => {
      router.push('/')
    })

  }
}