<template>
  <aside
    class="transform top-0 right-0 w-1/3 bg-gray-100 fixed h-full overflow-auto ease-in-out transition-all duration-300 z-30"
    :class="state ? 'translate-x-0' : 'translate-x-full'"
  >
    <div v-if='status === Status.RUNNING'>Carregando...</div>
    <form
      v-if='user'
      @submit='handleForm'>
      <p class='mt-10 mb-5 mx-10 py-2  text-xl text-gray-700 border-b border-gray-300'>Informações</p>
      <div class='py-5 px-10'>
        <label for="fantasy_name" class="sr-only">Nome fantasia: </label>
        <input 
          v-model='user.fantasy_name'
          name="fantasy_name"
          type="text"
          autocomplete="email"
          class="appearance-none relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:border-indigo-600 focus:z-10 sm:text-sm" 
          required
        >
      </div>

      <div class='py-5 px-10'>
        <label  for="fantasy_name" class="sr-only">Razão social: </label>
        <input 
          v-model='user.company_name'
          name="company_name"
          type="text"
          class="appearance-none relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:border-indigo-600 focus:z-10 sm:text-sm" 
          required
        >
      </div>
      <div class='py-5 px-10'>
        <label  for="fantasy_name" class="sr-only">CNPJ: </label>
        <input 
          v-model='user.cnpj'
          name="cnpj"
          type="text"
          class="appearance-none relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:border-indigo-600 focus:z-10 sm:text-sm" 
          required
        >
      </div>

      <div class='py-5 px-10'>
        <label  for="fantasy_name" class="sr-only">E-mail: </label>
        <input 
          v-model='user.email'
          name="email"
          type="email"
          class="appearance-none relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:border-indigo-600 focus:z-10 sm:text-sm" 
          required
        >
      </div>

      <div class='py-5 px-10'>
        <label for="tel" class="sr-only">Telefone: </label>
        <input 
          v-model='user.tel'
          name="tel"
          type="tel"
          class="appearance-none relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:border-indigo-600 focus:z-10 sm:text-sm"
          placeholder="Telefone"
        >
      </div>

      <div class='py-5 px-10'>
        <label for="whatsapp" class="sr-only">Whatsapp: </label>
        <input 
          v-model='user.whatsapp'
          name="whatsapp"
          type="tel"
          class="appearance-none relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:border-indigo-600 focus:z-10 sm:text-sm"
          placeholder="Whatsapp"
        >
      </div>
      <div class='py-5 px-10'>
        <base-button>Salvar informações</base-button>
      </div>

    </form>


  </aside>
  <div 
    @click='toggleSidebar()'
    :class="state ? 'flex' : 'hidden' "
    class='top-0 left-0 right-0 modal-overlay fixed w-full h-full bg-gray-900 opacity-50'></div>
</template>

<script>
import { onBeforeMount, ref } from 'vue'
import Api, { Status } from '@/Api/';
import { useStore } from '@/store/store';
export default({
  props: {
    state: {
      default: false, 
    },
    refItem: {
      default: null
    },
    toggleSidebar: {
      type: Function
    }
  },
  setup() {
    const user = ref('');

    const { onShow } = Api();
    const { currentCustomer } = useStore();

    onBeforeMount( async() => {
      if(status !== Status.IDLE)
        user.value = await onShow('admin/users', currentCustomer.value)
    })

    return { user, Status, status }
  },
})
</script>
