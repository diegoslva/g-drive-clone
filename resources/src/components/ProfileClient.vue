<template>
  <div v-if='status === Status.RUNNING'>Carregando...</div>
  <div
    v-else 
    class="profile__client  border-gray-200 border-b">
    <router-link :to="{ name: 'clientes' }">
      <img src="/images/arrow-right.svg" alt="Voltar" />
    </router-link>
    <span class="profile__client-title">#{{data.id}}</span>
    <h2 class="profile__client-name">{{data.fantasy_name}}</h2>
    <div class="profile__client-item">
      <span class="profile__client-title text-gray-500">{{data.name}}</span>
      <p class="profile__client-text">{{ data.cnpj }}</p>
    </div>
    
    <div class="profile__client-item">
      <span class="profile__client-title text-gray-500">Munícipio</span>
      <p class="profile__client-text">Praia Grande / SP</p>
    </div>
    
    <div class="profile__client-item">
      <span class="profile__client-title text-gray-500">Data do cadastro</span>
      <p class="profile__client-text">{{ data.created_at }}</p>
    </div>
    <div class="profile__client-item">
      <span class="profile__client-title text-gray-500">Plano</span>
      <p class="profile__client-text">Plano 3 </p>
    </div>
    <span 
      class="profile__client-status"
      :class="data.status"
    >{{data.status}}</span>
    
    <div class="menu">
      <button>
        <img src="/images/menu.svg" alt="Menu" />
      </button>

      <div class="menu__dropdown bg-white">
        <button 
          @click="handleSidebar('sidebar')" 
          class="menu__dropdown-action"
        >Ver perfil</button>

        <button class="menu__dropdown-action">Inativar</button>
        <button class="menu__dropdown-action activate">Ativar</button>
        <button class="menu__dropdown-action cancel">Cancelar</button>
      </div>
    </div>
  
  </div>
  
  <sidebar 
    :state='stateSidebar'
    :refItem='currentCustomer'
    :toggleSidebar="() => handleSidebar('sidebar')"
  ></sidebar>


</template>

<script>
import TDrive from '@/components/TDrive.vue'
import Sidebar from '@/components/Sidebar.vue'
import { ref, onBeforeMount, defineComponent } from 'vue'
import Api, { Status } from '@/Api/';
import { useStore } from '@/store/store';

export default defineComponent({

  components: {
    TDrive,
    Sidebar
  },
  
  setup() {
    let data = ref('');
    let stateSidebar = ref(false)

    const { currentCustomer, isAdmin } = useStore();
    const { onShow, getApi, status} = Api();
    
    onBeforeMount(async () => {
      if(isAdmin.value && currentCustomer.value) {
        data.value =  await onShow('admin/users', currentCustomer.value);
      } else {
        data.value =  await getApi('users');
      }

    })

    const handleSidebar = () => {
      stateSidebar.value = !stateSidebar.value;
    }

    return { 
      data,
      handleSidebar,
      stateSidebar,
      currentCustomer,
      status,
      Status
    }

  }
  
})
</script>


<style scoped>

.profile__client {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 0 0 1.125rem;
  padding: 0 0 1.5rem;
}
.profile__client-name {
  font-size: 2rem;
  line-height: 2.75rem;
  font-weight: 500;
}
 @media (max-width: 1300px) {
  .profile__client-name {
    font-size: 1.5rem;
	}
}
.profile__client-title {
  display: inline-block;
  font-size: 0.875rem;
  line-height: 1.375rem;
}
.profile__client-status {
  padding: 1.25rem 1.5rem;
  height: 2rem;
  border-radius: 2.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
}
.profile__client-status.Ativo {
  background: #29CC97;
  color: white;
}
.profile__client-status.Pendente {
  background: #F496D1;
  color: white
}
.profile__client .menu button {
  background: transparent;
  border: 0;
}
.profile__actions {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1.5rem 1.125rem;
  margin: 0 0 1.5rem;
  border-bottom: 1px solid var(--gray-4);
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
.profile__actions-dropdown button span {
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