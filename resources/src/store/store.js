import { computed, provide, inject, reactive, ref} from "vue";

export const initStore = () => {
  const user = reactive({
    id: '',
    name: ''
  });

  const stateModal = ref(false);

  const currentUserStore = (id)  => {
    user.id = id;
  }
  const getUserId = computed(() => user.id)
  
  const isAdminCheck = computed(() => {
    if(window.Laravel.isLoggedin) {
      console.log('provide', window.Laravel.isLoggedin)
  
      const role = window.Laravel.user.roles;
      return role === 'Admin'
    }
  });

  const toggleStateModal = () => {
    return stateModal.value = !stateModal.value
  }

  const getStateModal = () => {
    return stateModal.value
  }

  const handleFileUpload = async (e) => {
    let files = e.target.files;
    let formData = new FormData();
    
    for (var i = 0; i < files.length; i++) {
      formData.append('files[]', files[i]);
    }
    debugger;
    // formData.append('folder_id', folderID.value);

    // const response = await api.onStore('folders/media', formData)
    //   .then(() => {
    //     console.log('SUCCESS!!');
    //   }).catch(() => {
    //     console.log('FAILURE!!');
    //   });
    
    //   console.log(response);
  
  }

  provide('isAdminCheck', isAdminCheck)
  provide('currentUserStore', currentUserStore)
  provide('getUserId', getUserId)
  provide('toggleStateModal', toggleStateModal)
  provide('getStateModal', getStateModal)
  provide('handleFileUpload', handleFileUpload)

}
export const useStore = () => ({
  isAdmin: inject('isAdminCheck'),
  currentCustomer: inject('getUserId'),
  currentUserStore: inject('currentUserStore'),
  toggleStateModal: inject('toggleStateModal'),
  getStateModal: inject('getStateModal'),
  handleFileUpload: inject('handleFileUpload')
});

