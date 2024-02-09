<script setup lang="ts">

import { ref } from 'vue'
import { LoginService } from '@/services/LoginService'


let email = ref<string>('')
let password = ref<string>('')
let isValidEmail = ref<boolean>(true)
let isValidPassword = ref<boolean>(true)

function login() {
  validateEmail()
  validatePassword()
  if (isValidEmail.value && isValidPassword.value)
    LoginService.login({ email: email.value, password: password.value })
}

function validateEmail() {
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
  if (!emailRegex.test(email.value)) {
    isValidEmail.value = false
  }
}

function disableEmailValidationError() {
  if (email.value === '') isValidEmail.value = true
}

function disablePasswordValidationError() {
  if (password.value === '') isValidPassword.value = true
}

function validatePassword() {
  const passwordRegex = /^.{8,}$/;
  if (!passwordRegex.test(password.value)) {
    isValidPassword.value = false
  }
}




</script>

<template>
  <div class="max-w-[1600px] mx-auto items-center flex text-soft w-full h-full">
    <div class="h-fit flex-1 flex-grow flex flex-col gap-[5.813rem]">
      <div class="flex items-center gap-[.75rem]">
        <h1 class="font-bold text-5xl tracking-wider">Lychat</h1>
        <span class="bg-primary rounded-[.313rem] py-[.563rem] px-[.75rem] font-semibold"
        >Open source</span
        >
      </div>
      <hr class="w-[6.625rem]" />
      <div class="flex flex-col gap-[1.625rem]">
        <div>
          <h1 class="text-7xl tracking-wide">Live Messaging Application</h1>
        </div>
        <div>
          <span class="text-gray-primary">Version 1.0 © Lychat. 2024</span>
        </div>
      </div>
      <div></div>
    </div>

    <div class="h-fit flex-1 flex-grow">
      <div class="pt-[7.188rem] pl-[6.813rem] pr-[8.125rem] pb-[7.875rem] bg-dark-primary">
        <div class="mb-[3.125rem]">
          <p class="font-semibold text-[2.5rem]">Login</p>
        </div>

        <div class="flex flex-col gap-[1.875rem] mb-[1.25rem]">
          <div class="flex flex-col gap-2">
            <div class="pl-[1.25rem] flex gap-[1.875rem] w-full outline-none bg-dark-accent">
              <img src="../assets/icons/mail.svg" alt="" />
              <input
                v-model="email"
                class="w-full py-[1.375rem] bg-transparent outline-none"
                type="text"
                placeholder="douglas@gmail.com"
                @input="disableEmailValidationError"
                @click="disableEmailValidationError"
              />
            </div>
            <div v-if="!isValidEmail">
              <span class="text-error font-semibold">Please enter a valid email address</span>
            </div>
          </div>

          <div>
            <div class="pl-[1.25rem] flex gap-[1.875rem] w-full outline-none bg-dark-accent">
              <img src="../assets/icons/lock.svg" alt="" />
              <input
                v-model="password"
                class="w-full py-[1.375rem] bg-transparent outline-none"
                type="password"
                placeholder="***********************"
                @input="disablePasswordValidationError"
                @click="disablePasswordValidationError"
              />
            </div>
            <div v-if="!isValidPassword">
              <span class="text-error font-semibold">Please ensure your password contains at least 8 characters.</span>
            </div>
          </div>
        </div>
        <div class="flex gap-2 mb-[1.75rem]">
          <input type="checkbox" class="accent-primary" />
          <p>Remember me</p>
        </div>
        <div class="w-full">
          <button @click="login" class="rounded-md w-full bg-primary py-[1.375rem] outline-none">Login</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
