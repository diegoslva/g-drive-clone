<template>
  <div class="profile__actions flex justify-between border-b border-gray-200">
    <div class="profile__actions-item">
      <!-- <h3 class="profile__actions-title">Drive</h3> -->
    </div>
  
    <div class="profile__actions-item show-dropdown">
      <button class="bg-indigo-800 inline-flex justify-center items-center text-white font-medium rounded-lg h-12 w-28">
        <img src='/images/plus.svg' alt="Novo" />
        <span>Novo</span>
      </button>

      <div class="profile__actions-dropdown">
        <button @click="toggleStateModal(true)">
          <img src='/images/folder.svg' alt="Nova pasta" />
          <span>Nova pasta</span>
        </button>
        
        <label class='inline-flex gap-2 cursor-pointer'>
          <img src='/images/upload.svg' alt="Upload de arquivo" />
          <span>Upload de arquivos</span>
          <input 
            class='hidden'
            ref='file'
            type="file" 
            @change='handleFileUpload()' 
            multiple
          />
        </label>

      </div>
    </div>

  </div>

</template>

<script>
import { ref, onBeforeMount} from "vue";
import Api from '@/Api/';
import { useStore } from '@/store/store';

export default {

setup() {
    
    const folderID = ref(null);
    const { toggleStateModal }  = useStore();
    const { onStore }  = Api();
    
    onBeforeMount(async() => {
      folderID.value = sessionStorage.getItem('refFolder')
    });
    

    async function handleFileUpload() {
      let files = event.target.files;
      let formData = new FormData();
      
      for (var i = 0; i < files.length; i++) {
        formData.append('files[]', files[i]);
      }
      
      formData.append('folder_id', folderID.value);

      const response = await onStore('admin/folders/media', formData)
        .then(() => {
          console.log('SUCCESS!!');
        }).catch(() => {
          console.log('FAILURE!!');
        });
      
      console.log(response);
    
    }
    

    return {
      handleFileUpload, 
      folderID,
      toggleStateModal
    }
  }

}
</script>
<style scoped>
.profile__actions {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1.5rem 1.125rem;
  margin: 0 0 1.5rem;
}
.profile__actions-item {
  position: relative;
}
.profile__actions-item.show-dropdown:hover .profile__actions-dropdown {
  opacity: 1;
  visibility: visible;
}
.profile__actions-dropdown {
  position: absolute;
  width: 11.688rem;
  border-radius: 0.375rem;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
  padding: 0.75rem;
  background: white;
  right: 0;
  opacity: 0;
  visibility: hidden;
}
.profile__actions-dropdown button {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  width: 100%;
  background: transparent;
  border: 0;
}
.profile__actions-dropdown  span {
  color: var(--gray-2);
  font-size: 0.875rem;
  line-height: 1.375rem;
}
.profile__actions-dropdown button + button {
  margin: 1rem 0 0;
}

.menu {
	position: relative;
}
.menu:hover .menu__dropdown {
  opacity: 1;
  visibility: visible;
  transform: translate3d(0%, 0, 0);
}
.menu__dropdown {
  position: absolute;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
  width: 9.625rem;
  border-radius: 0.375rem;
  background: white;
  top: -0.1rem;
  right: 1.5rem;
  opacity: 0;
  visibility: hidden;
  transform: translate3d(20%, 0, 0);
  transition: transform 0.3s cubic-bezier(0.75, 0, 0.25, 1);
  z-index: 10;
}
.menu__dropdown-action {
  margin: 0.313rem;
  padding: 0.188rem 0.313rem;
  display: block;
  font-size: 0.875rem;
  line-height: 1.375rem;
  color: var(--gray-2);
  border-radius: 0.25rem;
  transition: background 0.2s;
  width: -webkit-fill-available;
  height: 1.688rem;
  text-align: left;
}
.menu__dropdown-action:hover {
  background: #f2f0f9;
}
.menu__dropdown-action.activate {
  color: var(--green);
}
.menu__dropdown-action.activate:hover {
  background: var(--green);
  color: white;
}
.menu__dropdown-action.cancel {
  color: var(--red);
  margin: 0.375rem 0.313rem 0.313rem;
  border-top: 1px solid #f2f0f9;
}
.menu__dropdown-action.cancel:hover {
  background: var(--red);
  color: white;
}
 
</style>