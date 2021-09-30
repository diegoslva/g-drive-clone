<template>  
  <div 
    v-if="status === Status.RUNNING"
  >Carregando...</div>
  
  <div v-else>
    
    <base-table 
      :items='users'
    >
      <template 
        v-slot:default="item"
      >
        <base-table-item>
          <router-link 
            @click='currentUserStore(item.row.id)'
            :to="{ name: 'show-client', params: {id: item.row.id } }"
          >#{{ item.row.id }}</router-link>
        </base-table-item>
        
        <base-table-item>
          
          <router-link 
            @click='currentUserStore(item.row.id)'
            :to="{ name: 'show-client', params: { id: item.row.id } }"
          >{{ item.row.fantasy_name }}</router-link>

        </base-table-item>
        
        <base-table-item>
          <span class='text-gray-400 text-sm'>{{ item.row.name }}</span>
          <p class='text-gray-600'>{{ item.row.cnpj }}</p>
        </base-table-item>
        
        <base-table-item>
          <span class='text-gray-400 text-sm'> Município </span>
          <p class='text-gray-600'>{{ item.row.address }}</p>
        </base-table-item>
        
        <base-table-item>
          <span class='text-gray-400 text-sm'>Data do cadastro</span>
          <p class='text-gray-600'>{{ item.row.created_at }}</p>
        </base-table-item>

        <base-table-item>
          <badges :name='item.row.status'>{{ item.row.status }}</badges>
        </base-table-item>
      
      </template>
    
    </base-table>
  </div>

</template>

<script>
import { toRefs, reactive, onMounted, ref, defineComponent, provide} from "vue";
import Badges from '@/components/Badges.vue'
import Api, { Status } from '@/Api'
import { useStore } from '@/store/store'

export default defineComponent({
  components: {
    Badges
  }, 
  emits:['total'],
  setup(props, context) {
    let { getApi, status } = Api();
    let testeid = ref(0);
    const modalTarget = ref({
      FormNewFolder: false
    });
    const { currentUserStore } = useStore();

    let data = reactive({
      users: {},
      total: 0
    });
 
    onMounted(async() => {
      const response = await getApi('admin/users');
      data.users = response.data;
      data.total = response.total;
      context.emit('total', data.total)
    }) 

  
    return  {
      ...toRefs(data),
      modalTarget,
      status,
      Status,
      currentUserStore
    }
  },
})

</script>
