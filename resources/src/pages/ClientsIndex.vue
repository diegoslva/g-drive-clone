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
            
            <router-view></router-view>

            <base-modal header="Nova pasta">
              <form @submit.prevent='submitForm'>
                <input
                  v-model='folderName'
                  className='appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-gray-200' 
                  placeholder="Pasta sem nome"
                />
                <button 
                  class='bg-indigo-800 inline-flex justify-center items-center text-white font-medium rounded-lg h-12 w-28 mr-3'
                >Criar</button>
                <button @click="() => toggleStateModal(true)">Cancelar</button>
              </form>
            </base-modal>
 
        </div>
      </section>
    </base-content>

  </base-layout>
</template>


<script>
import TDrive from '@/components/TDrive.vue'
import ProfileClient from '@/components/ProfileClient.vue'
import { ref, onBeforeMount, provide} from 'vue'
import TDriveActions from '@/components/TDriveActions.vue'
import Api from '@/Api/';
import { useStore } from '@/store/store';
import { useRoute } from 'vue-router'

export default {
  components: {
    TDrive,
    ProfileClient,
    TDriveActions
  },
  
  setup() {
    const route = useRoute();

    let data = ref('');
    let folderName = ref('');
    const folderID = ref(null)
    const userID = ref(route.params.id)

    const { toggleStateModal } = useStore();
    const { onStore } = Api();


    onBeforeMount(async () => {
      folderID.value = sessionStorage.getItem('refFolder');
      userID.value = sessionStorage.getItem('refItem');
      
      // setar valor no provide para eliminar o uso de sessionStorage
      provide('currentUser', userID.value)
    })

    
    const submitForm = async () => {
      
      const response = await onStore('folders', {
        user_id: userID.value,
        parent_id: folderID.value,
        name: folderName.value
      })
      
      if(response.status === 'Success') 
        toggleStateModal()
    }



    return { 
      data,
      submitForm, 
      folderName,
      toggleStateModal
    }

  }
  
}
</script>