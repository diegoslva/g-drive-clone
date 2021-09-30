<template>
  <base-layout>
    <base-sidebar>
      <base-navigation></base-navigation>
    </base-sidebar>

    <base-content>
      <section class="profile">
        <div class="container">
          <profile-client></profile-client>
          <t-drive-actions></t-drive-actions>
          
            <folder-list 
              :getDirectoryUser='userID'
            ></folder-list>
        </div>
      </section>
    </base-content>

  </base-layout>
</template>


<script>
import TDrive from '@/components/TDrive.vue'
import ProfileClient from '@/components/ProfileClient.vue'
import FolderList from '@/components/FolderList.vue'
import { ref, onBeforeMount } from 'vue'
import TDriveActions from '@/components/TDriveActions.vue'
import Api from '@/Api/';
import { useStore } from '@/store/store';
import { useRoute } from 'vue-router'

export default {
  components: {
    TDrive,
    ProfileClient,
    TDriveActions,
    FolderList
  },
  
  setup() {
    const route = useRoute();

    let data = ref('');
    let folderName = ref('');
    const userID = ref(route.params.id)

    const { toggleStateModal, currentUserStore, isAdmin} = useStore();
    const { onShow } = Api();

    onBeforeMount(async () => {
      if(isAdmin.value && userID.value) {
        data.value =  await onShow('admin/users', userID.value);
      } else {
        data.value =  await getApi('users');
      }
    })
    return { 
      data,
      folderName,
      toggleStateModal,
      userID
    }

  }
  
}
</script>