import axios from 'axios';

let api = axios.create({
  baseUrl: "api",
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  }
});
api.defaults.baseURL = '/api/';
api.defaults.withCredentials = true;

export default { 
    
  async fileUpload(e) {
    let files = e.target.files;
    let formData = new FormData();
    
    for (var i = 0; i < files.length; i++) {
      formData.append('files[]', files[i]);
    }

    const folderID = sessionStorage.getItem('refFolder')
    
    formData.append('folder_id', folderID);

    const response = await api.post('folders/media', formData)
      .then(() => {
        console.log('SUCCESS!!');
      }).catch(() => {
        console.log('FAILURE!!');
      });
    
    console.log(response);
  }
  

};