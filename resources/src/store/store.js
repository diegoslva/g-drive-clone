import { computed, provide, inject, reactive, ref} from "vue";

export const initStore = () => {
  const user = reactive({
    id: '',
    name: ''
  });

  let folder_ref  = ref(null);

  const stateModal = ref(false);
  const updated = ref(false);

  const currentUserStore = (id)  => {
    user.id = id;
    return id;
  }

  const setFolderId = (folder_id)  => {
    folder_ref.value = folder_id;
    return folder_id;
  }
  const getFolderId = computed(() => folder_ref.value)
  
  const getUserId = computed(() => user.id)


  
  const isAdminCheck = computed(() => {
    if(window.Laravel.isLoggedin) {
      const role = window.Laravel.user.roles;
      return role === 'Admin'
    }
  });

  const toggleStateModal = () => {
    return stateModal.value = !stateModal.value
  }
  
  const toggleUpdate = (state) => {
    return updated.value = state
  }
  const updateFolderList = () => updated.value;

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

  provide('setFolderId', setFolderId)
  provide('isAdminCheck', isAdminCheck)
  provide('currentUserStore', currentUserStore)
  provide('getUserId', getUserId)
  provide('getFolderId', getFolderId)
  provide('toggleStateModal', toggleStateModal)
  provide('toggleUpdate', toggleUpdate)
  provide('updateFolderList', updateFolderList)
  provide('getStateModal', getStateModal)
  provide('handleFileUpload', handleFileUpload)

}
export const useStore = () => ({
  isAdmin: inject('isAdminCheck'),
  currentCustomer: inject('getUserId'),
  setFolderId: inject('setFolderId'),
  currentUserStore: inject('currentUserStore'),
  toggleStateModal: inject('toggleStateModal'),
  toggleUpdate: inject('toggleUpdate'),
  updateFolderList: inject('updateFolderList'),
  getStateModal: inject('getStateModal'),
  handleFileUpload: inject('handleFileUpload'),
  getFolderId: inject('getFolderId')
});

