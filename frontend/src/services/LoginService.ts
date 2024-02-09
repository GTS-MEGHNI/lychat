import type { LoginData } from '@/types/user'
import axios from 'axios'
import store from '@/store'
import router from '@/router'

export class LoginService {

  static async login(data: LoginData) {
    if(this.isFormValid(data)) {
      const response = await axios.post('http://localhost:8000/api/auth/login', data)
      store.dispatch('userLogged', response.data).then(() => {
        router.push('/')
      })
    }

  }

  static isFormValid(data: LoginData): boolean {
    return !(data.email === '' || data.password === '');
  }

}