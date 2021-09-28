<template>
  <base-layout>
    <base-sidebar>
      <base-navigation></base-navigation>
    </base-sidebar>
      
    <base-content>
      
      <div class='py-4 border-b border-solid border-gray-400 flex justify-between mb-5'>
        <h2 class='text-2xl text-gray-900 pb-4 font-medium'>Lista de clientes</h2>
        <p>Total de {{ total }} clientes</p>
      </div>

      <customers-table
        @total='(payload) => total = payload'
      ></customers-table>
      
    </base-content>
  </base-layout>

</template>

<script>
import CustomersTable from '@/components/CustomersTable.vue'
import { ref } from "vue";
export default {
  components: {
    CustomersTable
  },

  setup() {
    const total = ref(0);
    
    return { total }
  }

}

</script>
