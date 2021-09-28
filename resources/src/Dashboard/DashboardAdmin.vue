<template>
  <div class="mb-10">
    <div class="flex flex-wrap -mx-6">
      
      <template 
        v-for="(item, index) in stats"
        :key="index"
      >
        <t-card 
          :header="'Clientes ' + item.status"
          :customClass=" item.status === 'Ativo' ? 'bg-indigo-600' : '' "
        >{{ item.total }}</t-card>
        
      </template> 
    </div>
  </div>    
      
  <div class='text-2xl text-gray-900 pb-4 border-b border-gray-200 font-medium'>Clientes pendentes de aprovação</div>

  <customers-table></customers-table>

</template>

<script>
import TCard from '@/components/TCard.vue'
import customersTable from '@/components/CustomersTable.vue'
import { onMounted, ref } from "vue";
import Api from '@/Api'
export default {
  components: {
    TCard,
    customersTable
  },

  setup(){
    let stats = ref('');
    let { getStatsCustomers } = Api();
    
    onMounted(async() => {
      stats.value = await getStatsCustomers();
    });

    return  { 
      stats
    
    }
  }
}
</script>
