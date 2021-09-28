<template>
  <div class="menu">
    <button>
      <img src="/images/menu.svg" alt="Menu" />
    </button>

    <div class="menu__dropdown bg-white">
     <router-link 
      class="menu__dropdown-action"
      :to="{ name: 'show-client', params: { id: user_id } }"
      >Ver perfil</router-link>

      <button @click="handleChangeStatus('Inativo')" class="menu__dropdown-action">Inativar</button>
      <button @click="handleChangeStatus('Ativo')" class="menu__dropdown-action">Ativar</button>
    </div>
  </div>
</template>

<script>
import api from '@/Api/';
export default {
  props: ['user_id'],
  
  setup(props){
    const handleChangeStatus = async (status) => {
      const response = await api.onUpdate(`users/${props.user_id}`, {'status': status})
    }
    return { handleChangeStatus }
  }
}
</script>

<style scoped>

.menu {
	position: relative;
}
.menu:hover .menu__dropdown {
  opacity: 1;
  visibility: visible;
  transform: translate3d(0%, 0, 0);
  background-color: white;
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
  color: green;
}
.menu__dropdown-action.activate:hover {
  background: green;
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