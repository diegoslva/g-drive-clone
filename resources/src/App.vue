<template>
  <router-view></router-view>
</template>

<script>
import { initStore } from "@/store/store";
import {defineComponent } from "vue";
export default defineComponent({
  setup() {
    initStore();
  },
})
</script>
