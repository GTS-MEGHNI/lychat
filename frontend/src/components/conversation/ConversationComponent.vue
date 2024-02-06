<script setup lang="ts">
import ConversationMessageComponent from '@/components/conversation/ConversationMessageComponent.vue'
import SelfMadeMessageComponent from '@/components/conversation/SelfMadeMessageComponent.vue'
</script>

<template>
  <div class="bg-dark-surface w-full pl-[1.875rem] pt-[1.875rem] pr-[2.313rem]">
    <div class="flex items-center text-soft mb-[3.75rem]">
      <div class="min-w-[3.75rem] min-h-[3.75rem] mr-[1.125rem]">
        <img src="../../assets/pictures/avatar-7.png" alt="" />
      </div>
      <div class="flex flex-col">
        <span class="text-3xl">Alexander Thompson</span>
        <span class="text-gray-primary text-sm">Active 4h ago</span>
      </div>
    </div>
    <div>
      <ConversationMessageComponent
        :should-display-info="true"
        content="Hi, Are you still Web Designer ?"
        contentType="text"
      />
      <ConversationMessageComponent
        :should-display-info="false"
        content="Hi, Are you still Web Designer ?"
        contentType="text"
      />
      <ConversationMessageComponent
        :should-display-info="false"
        content="Hi, Are you still Web Designer ?"
        contentType="text"
      />
      <ConversationMessageComponent
        :should-display-info="false"
        contentType="image"
        content="https://wallpapersmug.com/download/2560x1440/c1284b/moraine-lake-banff-national-park.jpg"
      />
      <SelfMadeMessageComponent
        :should-display-info="true"
        content="Hi, Are you still Web Designer ?"
        contentType="text"
      />
      <SelfMadeMessageComponent
        :should-display-info="false"
        content="Hi, Are you still Web Designer ?"
        contentType="text"
      />
      <SelfMadeMessageComponent
        :should-display-info="false"
        content="Hi, Are you still Web Designer ?"
        contentType="text"
      />
    </div>
  </div>
</template>

<style scoped></style>
