<template>
  <base-layout>
    <base-sidebar>
      <base-navigation></base-navigation>
    </base-sidebar>
      
    <base-content>
      <div v-if='isAdmin'> 
        <dashboard-admin></dashboard-admin>
      </div>

      <div v-else>
        <dashboard-customer></dashboard-customer>
      </div>

    </base-content>
  </base-layout>

</template>

<script>
import { defineComponent} from "vue";
import DashboardAdmin from '@/Dashboard/DashboardAdmin.vue'
import DashboardCustomer from '@/Dashboard/DashboardCustomer.vue'
import api from '@/Api/';

export default defineComponent({
  components: {
    DashboardAdmin,
    DashboardCustomer
  },

  setup(){
    
    let { isAdmin } = api();
    
    return  { 
      isAdmin
    }
  }
});

</script>
