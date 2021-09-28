<script>
import { ref } from "vue";
export default {

  props: ['folderInfo', 'files', 'children'],
  setup() {
    
    let fields = [
      {'text': ''},
      {'text': 'Nome'},
      {'text': 'Compartilhado por'},
      {'text': 'Última atualização'},
      {'text': 'Tamanho do arquivo'},
    ];
    
    const mousedown = (event) => {
      if (event.which === 3) {
        console.log("Right mouse down");        
      }
    }

    const mouseup = (event) => {
      if (event.which === 3) {
        console.log("Right mouse up");
      }
    }

    const formatBytes = (bytes, decimals = 2) => {
      if (bytes === 0) return '0 Bytes';

      const k = 1024;
      const dm = decimals < 0 ? 0 : decimals;
      const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

      const i = Math.floor(Math.log(bytes) / Math.log(k));

      return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }
    return { mouseup, mousedown, fields, formatBytes }
  } 


}
</script>


<template>

<div 
  class='drive__container'
  @mousedown.right="mousedown" 
  @mouseup.right="mouseup" 
  @contextmenu.prevent
>
  <div class="profile__folders">
    <span class="profile__folders-title">Pastas</span>
    
    <div
      v-if="children" 
      class="profile__folders-list grid grid-cols-4 gap-10">
      <div
        v-for="(folder, index) in children" 
        v-bind:key='index'
      >
        <router-link 
          :to="{ name: 'folder', params: { id: folder.id } }"
          class="inline-flex items-center border border-gray-200 py-3 px-6 rounded-sm w-full">
          <img src='/images/folder.svg' alt="Nome da pasta" />
          <span class='ml-2 leading-5 text-gray-600 text-sm'>{{folder.name}}</span>
        </router-link>
      </div> 
    </div>

  </div>

  <div class="profile__archive">
    <span class="profile__archive-title">Arquivos</span>

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
</div>

</template>


<style scoped>
.profile__folders {
  padding: 0 1.5rem;
}
.profile__folders-title {
  display: inline-block;
  color: var(--gray-3);
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
  color: var(--gray-3);
  font-weight: 500;
  line-height: 1.5rem;
  margin: 0 0 1.5rem;
}

.files-table {
  width: 100%;
  border-spacing: 0 0.5rem;
}
.files-table thead {
  margin: 0 0 0.844rem;
}
.files-table th {
  font-weight: 400;
  font-size: 0.875rem;
  line-height: 3.063rem;
  color: var(--gray-2);
  text-align: left;
}
.files-table td {
  padding: 0.5rem 0.75rem;
  line-height: 2.5rem;
  font-size: 0.875rem;
  color: var(--gray-2);
}
.files-table__name {
  font-weight: 400;
  font-size: 0.875rem;
  line-height: 1.375rem;
}

</style>