<template>
  <t-drive
    v-if='folders'
    :folderID='folders.id'
    :folders='folders.children'
    :files='folders.files'
  ></t-drive>
  <div v-else class='text-center text-gray-300'>Sem arquivos ou pastas</div> 

</template>

<script>
import TDrive from '@/components/TDrive.vue'
import { useRoute } from 'vue-router'
import { ref, onBeforeMount} from 'vue'
import Api, { Status } from '@/Api'
import { useStore } from '@/store/store'

export default {
  components: {
    TDrive
  },
  
  setup() {
    const route = useRoute();
    let folders = ref('');

    let { status, onShow, getApi} = Api();
    
    let { isAdmin } = useStore();
    
    onBeforeMount(async () => {
      console.log(route.params.id);
      if(isAdmin.value) {
        folders.value =  await onShow('folders', route.params.id)
      } else {
        folders.value =  await getApi('users');
      }
      sessionStorage.setItem('refFolder', route.params.id)
    })

    return { 
      folders,
      status,
      Status
    }

  }
  
}
</script>