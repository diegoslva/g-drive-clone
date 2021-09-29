import axios from 'axios';
import { ref, provide, inject} from "vue";

let api = axios.create({
  baseUrl: "api",
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  }
});
api.defaults.baseURL = '/api/';
api.defaults.withCredentials = true;

export const Status = {
  IDLE: "IDLE",
  RUNNING: "RUNNING",
  SUCCESS: "SUCCESS",
  ERROR: "ERROR",
};

export const currentUserStore = (id)  => {
  provide('getUserId', id)
}
// const getUserId = computed(() => user.id)

export const currentUserOn = () => {
  inject('getUserId');
}

export const currentUser = () => ({
  getUserId: inject('getUserId')
});

export default function Api(){ 
  let status = ref(Status.IDLE);

  // let fetch = ref(await fetchApi());

  const fetchApi = async (HTTP, url) => {
    status.value = Status.RUNNING
    try {
      const response = await fetch( '/api/' + url, {
        method: HTTP,
        headers: {
          'Accept': "application/json",
          'content-type': "application/json"
        }
      })
        if(!response.ok) {
          status.value = Status.ERROR
        }
        const json = await response.json();
        status.value = Status.SUCCESS

        return json;

    } catch (err) {
      status.value = Status.ERROR;
      throw new Error(err);
    }
  }

  const checkIsAdmin = () => {
    if(window.Laravel.isLoggedin) {
      const role = window.Laravel.user.roles;
      return role === 'Admin'
    }
  }
  
  let isAdmin = ref( checkIsAdmin() )


  async function login(data){

    return await Promise.all([ csrf(), submit(data.email, data.password) ])
      .then(response => {
        response[0].status === 204 && response[1].status === 200 
        ? window.location.href = "/dashboard"
        : response[1].status
      }).catch( () => {
        status.value = Status.ERROR
      })
  }

  const logout = async () => {
    await axios.get('/sanctum/csrf-cookie').then(response => {
      api.post('/auth/logout')
        .then(response => {
          if (response.data.status) {
            window.Laravel.isLoggedin = false;
            window.location.href = "/"
          } else {
            console.log(response)
          }
        })
        .catch( error => console.log(error));
    })
  }
  
  const csrf = async () => {
    return axios.get('sanctum/csrf-cookie');
  }

  const submit = (email, password) => {
    return api.post('auth/login', { 'email': email, 'password': password } )
  }

  const getApi = async (payload) => {
    const response = await fetchApi('GET', payload)
    return response;
  }

  const onEdit = async (payload) => {
    return await api.get(`${payload.apiEndpoint}/${payload.item.id}`)
  } 
  
  const onShow = async (endpoint, id) => {
    const response = await fetchApi('GET', `${endpoint}/${id}`)
    return response;
  } 
  
  const onUpdate = async (payload, data) =>{
    const response = await api.put(payload, data)
    return response.data;
  }
  
  const onDelete = async (apiEndpoint, id) => {
    const response = await api.delete(`${apiEndpoint}/${id}`)
    return response.data
  }
  
  const onStore = async (endpoint, fields) => {
    const response = await api.post(endpoint, fields) 
    return response.data
  }

  const getFolderDirectory = async (payload) => {
    const response = await api.get(`admin/folders/directory/${payload}`)
    return response.data;
  }

  const currentUserDirectory = async () => {
    const response = await api.get(`folders/directory`)
    return response.data;
  }
  
  // orcamentos
  const getRoles = () => {
    return api.get('users/roles')
  }
    
  const getStatsCustomers = async (params) =>{
    if(!isAdmin)
      return;
    const response = await api.get('admin/customers/stats', {'stats': params})
    return response.data;
  }
  

 
  
  return {
    status,
    isAdmin,
    login,
    logout,
    getApi,
    onEdit,
    checkIsAdmin,
    onShow,
    onUpdate,
    onDelete,
    onStore,
    getFolderDirectory,
    currentUserDirectory,
    getRoles,
    getStatsCustomers
  }

};


// export {
  
// }