<script setup lang="ts"></script>

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
          <div class="pl-[1.25rem] flex gap-[1.875rem] w-full outline-none bg-dark-accent">
            <img src="../assets/icons/mail.svg" alt="" />
            <input
              class="w-full py-[1.375rem] bg-transparent outline-none"
              type="text"
              placeholder="douglas@gmail.com"
            />
          </div>
          <div class="pl-[1.25rem] flex gap-[1.875rem] w-full outline-none bg-dark-accent">
            <img src="../assets/icons/lock.svg" alt="" />
            <input
              class="w-full py-[1.375rem] bg-transparent outline-none"
              type="password"
              placeholder="***********************"
            />
          </div>
        </div>

        <div class="flex gap-2 mb-[1.75rem]">
          <input type="checkbox" class="accent-primary" />
          <p>Remember me</p>
        </div>
        <div class="w-full">
          <button class="rounded-md w-full bg-primary py-[1.375rem]">Login</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
