<template>
  <t-drive 
    :folderID='folders.id'
    :folders='folders.children'
    :files='folders.files'
  ></t-drive> 

</template>

<script>
import api from '@/Api/';
import { ref, onBeforeMount} from 'vue'
import TDrive from '@/components/TDrive.vue'

export default {
  components: {
    TDrive
  },
  setup() {
    
    let folders = ref('');
    let { currentUserDirectory } = api();
    
    onBeforeMount(async () => {
      folders.value = await currentUserDirectory();
      sessionStorage.setItem('refItem', folders.user_id)
    })
    
    return { folders }

  },
}
</script>
