<template>
  <div 
    v-if="getStateModal()"
    class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
    
    <div @click='toggleStateModal()' class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50">{{ getStateModal }}</div>
    <div class="modal-container bg-gray-100 w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50">
      <div 
        @click='toggleStateModal' 
        class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50"
      >
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>
      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->

        <div class="flex justify-between items-center pt-5 pb-4">
          <p class="text-2xl font-bold">{{header}}</p>
          <div
            @click='toggleStateModal()' 
            class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <slot></slot>
        
      </div>
    </div>
  </div>

</template>
<script>
import { ref } from "vue";
import { useStore } from '@/store/store'
export default {
  name: 'modal',
  props: {
    
    header: {
      type: String
    }
  },

  setup() {
    
    const stateModal = ref(false)

    let { getStateModal, toggleStateModal }  = useStore();
    
    stateModal.value = getStateModal();
    
    return {
      toggleStateModal,
      stateModal,
      getStateModal
    }
  }




}
</script>