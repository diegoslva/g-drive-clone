<template>
  <div v-if='isLoading'>Carregando...</div>
  <t-drive
    v-else 
    :folderID='folders.id'
    :folders='folders.children'
    :files='folders.files'
  ></t-drive> 
</template>

<script>
import TDrive from '@/components/TDrive.vue'
import { useRoute } from 'vue-router'
import { ref, onBeforeMount, getCurrentInstance, inject} from 'vue'
import Api from '@/Api/';

export default {

  components: {
    TDrive
  },
  
  setup() {
    const route = useRoute();
    let folders = ref('');
    let isLoading = ref('');

    let { getFolderDirectory } = Api();
    
    async function updateFolderList() {
      folders.value =  await getFolderDirectory(route.params.id);
      isLoading.value = false
    }

    onBeforeMount(async () => {
      folders.value =  await getFolderDirectory(route.params.id);
      // 
      sessionStorage.setItem('refFolder', folders.value.id);

      // if(updatedFolder) {
      //   updateFolderList();
      // }
      // user laravel broadcast para atualizar a lista de pasta

    })

    return { folders, isLoading}

  }
  
}
</script>