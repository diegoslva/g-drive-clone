<template>
  <div
    class="contextDropdown absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20 max-w-xs"
    v-bind:style="{ left: screenX + 'px', top: screenY + 'px' }"
  >
    <a 
      @click='toggleStateModal'
      class='inline-flex gap-2 items-center px-4 py-3 border-b hover:bg-gray-100 w-full'>
      <img src='/images/folder.svg' alt="Nova pasta" />
      <span>Nova pasta</span>
    </a>

    <label class='inline-flex gap-2 items-center px-4 py-3 border-b hover:bg-gray-100 w-full'>
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
</template>

<script>

import actions from '@/plugins/uploads/';
import { useStore } from '@/store/store';

export default ({
  props: ['screenX', 'screenY'],
  
  setup() {
    const { toggleStateModal, handleFileUpload } = useStore();

    return {
      handleFileUpload,
      toggleStateModal
    }
  },
})
</script>
