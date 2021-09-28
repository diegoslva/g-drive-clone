<template>
  <div 
    :class="status[name]"
    class="py-2 px-6 text-center center text-sm leading-5 inline-flex mx-auto font-normal text-white rounded-full"
  >
    <slot></slot>
  </div>
</template>

<script>
import { ref } from "vue";


export default ({
  props: ['name'],
  
  setup() {

    const status = ref({
      'Pendente': 'Pendente',
      'Ativo': 'bg-green-400',
      'Inativo': 'bg-gray-400',
      'Cancelado': 'bg-red-400' 
    })

    return { status }
  },
})
</script>
<style scoped>

.Ativo {
  background: #29CC97;
  color: white;
}
.Pendente {
  background: #F496D1;
  color: white
}
</style>
