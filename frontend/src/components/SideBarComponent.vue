<script setup lang="ts">

import { onBeforeMount, reactive, ref } from 'vue'
import { useStore } from 'vuex'
import type { Participant } from '@/types/conversation'
import { useRouter } from 'vue-router'

let user: Participant | {} = reactive({})
let toggleMenu = ref<boolean>(false)
let router

onBeforeMount(() => {
  const store = useStore()
  router = useRouter()
  user = store.getters.getUser
})

function logout() {
  localStorage.removeItem('user')
  router.push('auth')
}


</script>

<template>
  <div class="mx-auto py-4 flex justify-between flex-col bg-dark-primary w-[5.875rem] h-full">

    <!-- Logo -->
    <div class="w-full h-fit">
      <img class="w-14 h-14 mx-auto" src="../assets/logo.svg" alt="" />
    </div>

    <!-- nav buttons -->
    <div class="w-fit mx-auto flex flex-col gap-[2.813rem] items-center">
      <div>
        <button>
          <img src="../assets/icons/group-1.svg" alt="" />
        </button>
      </div>
      <div>
        <button>
          <img src="../assets/icons/group-2.svg" alt="" />
        </button>
      </div>
      <div>
        <button>
          <img src="../assets/icons/group-3.svg" alt="" />
        </button>
      </div>
      <div>
        <button>
          <img src="../assets/icons/group-4.svg" alt="" />
        </button>
      </div>
      <div>
        <button class="rounded-[0.875rem] bg-primary">
          <img class="fill-red-800 p-[0.813rem]" src="../assets/icons/group-5.svg" alt="" />
        </button>
      </div>
      <div>
        <button>
          <img src="../assets/icons/group-6.svg" alt="" />
        </button>
      </div>
    </div>

    <div class="relative">
      <div v-if="toggleMenu" class="p-2 rounded-md flex items-end text-md absolute bottom-12 left-8 text-soft bg-dark-surface w-36 h-fit">
        <div class="ml-1 flex gap-2 items-center">
          <img class="w-4 h-4" src="../assets/icons/logout.svg" alt="">
          <button @click="logout">Log out</button>
        </div>
      </div>
      <div class="mx-auto w-10 h-10">
        <button @click="toggleMenu = !toggleMenu"><img :src="(user as Participant).avatarUrl" alt=""></button>
      </div>
    </div>

  </div>
</template>

<style scoped></style>
