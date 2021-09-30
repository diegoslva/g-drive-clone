<template>
  <div class="flex h-screen w-full px-10">
    <div class="flex-1 flex flex-col overflow-hidden">
      <header class="flex justify-between items-center py-4 px-6 ">
        <div class="flex items-center">
          <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </button>

          <div class="relative mx-4 lg:mx-0">
            <h3 class="text-gray-700 text-3xl font-medium">{{header ? header : 'Dashboard' }}</h3>
          </div>
        </div>

        <div class="flex flex-wrap items-center justify-end text-right">
          <span class="text-gray-700 text-1xl font-medium block">{{ data.user.name }}</span> <br>
          <button @click='logout' class='text-sm text-gray-400 block w-full text-right'>(Sair)</button>
        </div>

      </header>

      <main class="flex-1 overflow-y-auto">
        <div class="container mx-auto px-6 py-8">
          
          <slot></slot>
        
        </div>
      </main>
    </div>
  </div>
</template>


<script>
import api from '@/Api/'
import { reactive, onMounted } from "vue";
export default {
  props: ['header'],
  setup() {
    
    let data = reactive({
      user: ''
    })
    let { logout } = api();

    onMounted(async() => {
      data.user = window.Laravel.user
    })

    return { logout, data}
  }
}
</script>

