<template>
  <div 
    v-if='notification'
    class="bg-green-100 rounded-b text-teal-900 px-4 py-3 shadow-md w-auto inline-flex flex-wrap items-center overflow-hidden absolute top-3 right-4" role="alert">
  <div class="flex">
    <div class="py-1">
      <svg style='fill: #0f7857' class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
    <div>
      <p class="font-bold text-green-700">Salvo com sucesso!</p>
    </div>
  </div>
</div>
</template>

<script>
import { toRefs, reactive, watch } from "vue";

export default {
  props: ['state'],
  emits: ['update:notification'],
  
  setup(props, context) {
    
    let data = reactive({
      notification: false
    });
    
    watch( () => props.state, () => {
      notification();
    })

    async function notification() {
      data.notification = true;
      
      setTimeout(() => {
        data.notification = false

        context.emit('@update:notification', false)
      }, 2000);

    }
    
    return  {
      ...toRefs(data)
    }
  },
}

</script>