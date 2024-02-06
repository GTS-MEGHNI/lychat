<script setup lang="ts"></script>

<template>
  <div class="main-container w-[5.875rem] h-full absolute top-0 left-0">
    <div class="w-full h-fit pt-[1.25rem] mb-[9.438rem]">
      <img class="w-16 h-16 mx-auto" src="../assets/logo.svg" alt="" />
    </div>
    <div class="w-fit mx-auto flex flex-col gap-[2.813rem] items-center actions-container">
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
  </div>
</template>

<style scoped>
.main-container {
  background-color: #1e1f25;
}
</style>
