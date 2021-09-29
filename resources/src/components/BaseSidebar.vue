<template>
  <div 
    style="background-color: #292121"
    class="fixed z-30 inset-y-0 left-0 w-20 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 flex flex-wrap flex-col justify-between"
  >
    <div class="flex items-center justify-center bg-indigo-800 py-2">
      <img style='filter: brid' src="/images/logo.png" alt="">
    </div>
    
    <slot></slot>

    <div class='flex items-center justify-center mb-5'>
      <button @click='logout'>
        <img src="/images/logout.svg" alt="">
      </button>
    </div>
  
  </div>
</template>

<script>
import Api from '@/Api/'

export default {
  setup() {
    
    let { logout } = Api();
    return {
      logout
    }
  }
}
</script>