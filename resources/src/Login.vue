<template>
  <div class="min-h-screen grid grid-cols-1 sm:grid-cols-2">
    <div class="max-w-md w-full space-y-8 py-32 px-5 sm:px-10 m-auto">
      <div 
        v-if="status === Status.ERROR"
        class="flex items-center m-1 font-medium py-1 px-2 rounded-md text-red-700 bg-red-100 border border-red-300 "
      >
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-5 h-5 mx-2">
          <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
      <div class="text-xl font-normal  max-w-full flex-initial">A senha ou e-mail incorretos </div>
    </div>

    <h2 class="mt-6 text-3xl font-semibold text-gray-900">Bem-vindo <br> a plataforma g-clone drive</h2>
    <p class="mt-6 text-base font-normal text-gray-900">Preencha os campos abaixo e acesse sua conta</p>

    <form class="mt-8 space-y-6" @submit.prevent='onSubmit'>
      <input type="hidden" name="remember" value="true">
      <div class="shadow-sm -space-y-px">
        <div class='mb-5'>
          <label for="email-address" class="sr-only">E-mail: </label>
          <input v-model='email' name="email" type="email" autocomplete="email" required class="appearance-none relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:border-indigo-600 focus:z-10 sm:text-sm" placeholder="Email address">
        </div>
        <div class='mb-5'>
          <label for="password" class="sr-only">Senha: </label>
          <input v-model='password' name="password" type="password" autocomplete="current-password" required class="appearance-none relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:border-indigo-600 focus:z-10 sm:text-sm" placeholder="Password">
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input 
            v-model='remember_me'
            id="remember_me"
            name="remember_me" 
            type="checkbox" 
            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
          >
          <label for="remember_me" class="ml-2 block text-sm text-gray-900">
            Lembrar-me
          </label>
        </div>

        <div class="text-sm">
          <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
            Esqueci minha senha?
          </a>
        </div>
      </div>

      <div>
        <button 
          :disabled="password.length <= 0 ? true : false "
          :class="password.length <= 0 ? 'disabled:opacity-50' : '' "
          class="group relative w-full flex justify-center py-4 px-5 border border-transparent text-sm font-semibold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 items-center">
          Entrar
        </button>
      </div>
    </form>

  </div>
  
  <div 
    class='min-h-screen bg-cover' 
    style="background-image: url('/images/login-column.png')"
  ></div>

</div>
</template>

<script>
import { defineComponent, reactive, toRefs } from "vue";
import Api, { Status } from '@/Api'

export default defineComponent({
  setup() {
    
    let { login, status} = Api();
    const data = reactive({ email: "", password: "", remember_me: ""});
    
    const onSubmit = async () => await login(data)
      
    return { 
      ...toRefs(data),
      onSubmit, 
      status,
      Status
    }
  },

  beforeRouteEnter(to, from, next) {
    if (window.Laravel.isLoggedin) {
      return next('dashboard');
    }
    next();
  }

})
</script>