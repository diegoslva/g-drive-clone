<template>
  <div 
    style="background-color: #292121"
    class="fixed z-30 inset-y-0 left-0 w-20 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 flex flex-wrap flex-col justify-between"
  >
    <div class="flex items-center justify-center bg-indigo-800 p-5">
      <img src="/images/logo.png" alt="">
    </div>
    
    <slot></slot>

    <div class='flex items-center justify-center mb-5'>
      <button @click='onLogout'>
        <img src="/images/logout.svg" alt="">
      </button>
    </div>
  
  </div>
</template>

<script>
import api from '@/Api/'

export default {
  setup() {
    
    function onLogout() {
      return api.logout();
    }
    
    return {
      onLogout
    }
  }
}
</script>