<template>
  <t-drive
    :folderID='folders.id'
    :folders='folders.children'
    :files='folders.files'
  ></t-drive> 
</template>

<script>
import TDrive from '@/components/TDrive.vue'
import { ref, onBeforeMount, computed, watchEffect} from 'vue'
import Api from '@/Api/';
import { useStore } from '@/store/store';

export default {

  components: {
    TDrive
  },

  props: {
    getDirectoryUser: {
      required: true
    }
  },
  
  setup(props) {
    let folders = ref('');
    let { getFolderDirectory, } = Api();
    let { setFolderId, updateFolderList, toggleUpdate } = useStore();
    
    onBeforeMount(async () => {
      folders.value =  await getFolderDirectory(props.getDirectoryUser);
      setFolderId(folders.value.id)
    })
    
    watchEffect(async () => {
      if(updateFolderList()) 
        folders.value =  await getFolderDirectory(props.getDirectoryUser);
        toggleUpdate(false);
    })

    return { folders }

  }
  
}
</script>