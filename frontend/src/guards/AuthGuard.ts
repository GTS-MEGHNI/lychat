import type { NavigationGuardNext, RouteLocationNormalized } from 'vue-router'
import store from '@/store'
import type { Participant } from '@/types/conversation'

export class AuthGuard {
  static guard(
    to: RouteLocationNormalized,
    from: RouteLocationNormalized,
    next: NavigationGuardNext
  ) {
    const isAuthenticated: boolean = Object.keys(store.getters.getUser as Participant).length !== 0
    if (!isAuthenticated) next({ name: 'auth' })
    else next()
  }
}
