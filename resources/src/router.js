import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from './Dashboard/Dashboard.vue'
import Login from './Login.vue'

/* webpackChunkName: "Tickets" */ 

const routes = [
  {
    path: '/',
    component: Dashboard,
  },
  {
    path: '/dashboard',
    component: Dashboard,
  },
  {
    name: 'clientes',
    path: '/dashboard/clientes',
    component: () => import('./pages/Clients.vue')
  },
  
  {
    name: 'show-client',
    path: '/dashboard/clientes/:id',
    component: () => import('./pages/ClientsIndex.vue')
  },
  {
    name: 'folder',
    path: '/dashboard/folders/:id',
    component: () => import('./components/FolderItem.vue'),
  },
  {
    name: 'login',
    path: '/login',
    component: Login
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})


router.beforeEach((to, from, next) => {
  if (to.name !== 'login' && !window.Laravel.isLoggedin) next({ name: 'login'})
  else {
    if (to.matched.some(record => record.meta.roleRequired)) {
      if (to.name === 'colaboradores') {
        if ( window.Laravel.user === 'admin') {
          next()
        }
      } else {
        if ( window.Laravel.user === 'admin' ||  window.Laravel.user == 'management') {
          next()
        }
      }
      next({ name: 'dashboard'})
    } else {
      next()
    }
  }
})

export default router
