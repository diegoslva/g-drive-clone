<template>
  <div 
    @mousedown.right="mousedown" 
    @contextmenu.prevent
    @dragenter.prevent="toggleActive"
    @dragleave.prevent="toggleActive"
    @dragover.prevent
    @drop.prevent="toggleActive"
    :class="{ 'active-dropzone': active }"
    class="dropzone"
  >
    <div 
      class="profile__folders">
      <span class="profile__folders-title text-gray-500">Pastas</span>
      <div class="profile__folders-list grid grid-cols-4 gap-14">
        <div
          v-for="(folder, index) in folders" 
          v-bind:key='index'
        >
          <router-link 
            :to="{ name: 'folder', params: { id: folder.id } }"
            class="inline-flex border border-gray-200 py-3 px-6 rounded-md w-full"
          >
            <img src='/images/folder.svg' alt="Nome da pasta" />
            <span class='ml-2'>{{folder.name}}</span>
          </router-link> 
        </div> 
      </div>

    </div>

    <div class="profile__archive">
      <span class="profile__archive-title text-gray-500">Arquivos</span>
      <base-table 
        :fields='fields' 
        :items='files'
        className='bg-gray-400'
      >
        <template v-slot:default="item">
          <base-table-item>
            <img 
              class='max-w-max max-h-9 m-auto'
              :src="item.row.thumbnail"
              :alt="item.row.name"
            >
          </base-table-item>
          
          <base-table-item>
            {{ item.row.name }}
          </base-table-item>
        
          <base-table-item>
            Criado por usuario
          </base-table-item>
          
          <base-table-item>
            {{ item.row.updated_at }}
          </base-table-item>
          
          <base-table-item>
            <span>{{ formatBytes(item.row.size) }}</span>
          </base-table-item>
          
        </template>

      
      </base-table>

    </div>

    <context-dropdown
      v-show='contextDropdown.state'
      :screenX='contextDropdown.screenX'
      :screenY='contextDropdown.screenY'
    ></context-dropdown>
  </div>


</template>

<script>
import { reactive, ref } from "vue";
import contextDropdown from "@/components/contextDropdown.vue";
import { useStore } from "@/store/store";


export default {
  components: {
    contextDropdown
  },
  props: ['folderID', 'folders', 'files'],

  
  setup(props) {
    const { handleFileUpload } = useStore();
    const active = ref(false);
    const toggleActive = (e) => {
      active.value = !active.value;
      console.log(e.dataTransfer.files);

      handleFileUpload(e)

    };

    let fields = [
      {'text': ''},
      {'text': 'Nome'},
      {'text': 'Compartilhado por'},
      {'text': 'Última atualização'},
      {'text': 'Tamanho do arquivo'},
    ];

    const contextDropdown = reactive({
      state: false,
      screenX: '', 
      screenY: ''
    });

    const formatBytes = (bytes, decimals = 2) => {
      if (bytes === 0) return '0 Bytes';

      const k = 1024;
      const dm = decimals < 0 ? 0 : decimals;
      const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

      const i = Math.floor(Math.log(bytes) / Math.log(k));

      return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }


    const mousedown = (event) => {
      if (event.which === 3) {
        console.log("Right mouse down");  
        contextDropdown.state = true
        contextDropdown.screenX = event.layerX + 100
        contextDropdown.screenY = event.layerY + 80

        addWindowEventListener();
      }
    }

    const mouseup = (event) => {
      if (event.which === 3) {
        console.log("Right mouse up");
      }
    }

    const addWindowEventListener = () =>{
      window.addEventListener('click', function() {
        contextDropdown.state = false
      }, false);
    }

    return { 
      formatBytes,
      fields,
      mousedown,
      mouseup,
      contextDropdown,
      toggleActive,
      active
    }
  } 

}
</script>

<style scoped>
.profile__actions-title {
  font-weight: 500;
  font-size: 1.5rem;
  line-height: 2.25rem;
  color: var(--gray-2);
}
.profile__folders {
  padding: 0 1.5rem;
}
.profile__folders-title {
  display: inline-block;
  font-weight: 500;
  line-height: 1.5rem;
  margin: 0 0 1.5rem;
}
.profile__folders-list {
  gap: 1.5rem;
  width: 100%;
}
.profile__folders-item {
  display: flex;
  align-items: center;
  gap: 1.125rem;
  padding: 1rem;
  border-radius: 0.25rem;
}
.profile__folders-item span {
  font-weight: 400;
  font-size: 0.875rem;
  line-height: 1.375rem;
  color: var(--gray-2);
}
.profile__archive {
  padding: 2.875rem 1.5rem;
}
.profile__archive-title {
  display: inline-block;
  font-weight: 500;
  line-height: 1.5rem;
  margin: 0 0 1.5rem;
}

.active-dropzone {
  border-width: 3px;
  border-style: solid;
  border-color: #41a0f8;
  background-color: #b2e9ff5d
}
.active-dropzone label {
  background-color: #fff;
  color: #41b883;
}

</style>