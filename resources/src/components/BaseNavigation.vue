<template>
  <nav class="mt-10">
    <router-link
      class="text-base flex items-center mt-2 p-6 hover:bg-indigo-600 hover:text-white"
      active-class="bg-gray-700 bg-opacity-25"
      :to="{ path: '/' }"
    >
      <img src="/images/home.svg" alt="">

    </router-link>
    
    <router-link
      v-if="isAdmin"
      active-class="bg-gray-700 bg-opacity-25 text-white"
      class="text-base text-white flex items-center mt-2 p-6 hover:bg-indigo-600 hover:text-white"
      :to="{ name: 'clientes' }"
    >
      <img src="/images/clients.svg" alt="">

    </router-link>
    
  </nav>
</template>
<script>
import Api from '@/Api'
export default {

  setup() {
    const { isAdmin } = Api();
    
    return { isAdmin }
  }
}
</script>


