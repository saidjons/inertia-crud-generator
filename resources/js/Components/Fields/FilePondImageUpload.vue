<script>
// Import Vue FilePond
import vueFilePond from "vue-filepond";

// Import FilePond styles
import "filepond/dist/filepond.min.css";

// Import FilePond plugins
// Please note that you need to install these plugins separately

// Import image preview plugin styles
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

// Import image preview and file type validation plugins
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import {  setOptions } from 'vue-filepond';


// Create component
const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview
);

    export default {
        
    props:['name','label','initialValue'],
    components: {
        FilePond,
    },
    beforeMount() {
        
            window.addEventListener('imageUploaded', (evt)=>{
            alert('caught ')
            this.emitImageUploaded(evt.detail);
        });
    },

  

       mounted() {

      
             setOptions({
            
                     server: {
                         revert: {
                            url: '',
                    },

                           headers: {
                            'Authorization':'Bearer '+window.token,
                            'X-CSRF-TOKEN':window.csrf,
                        },
                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                          
                            const formData = new FormData();
                            formData.append(fieldName, file, file.name);

                            const request = new XMLHttpRequest();
                            request.open('POST', '/api/admin/upload/image/article');

                          
                            request.upload.onprogress = (e) => {
                                progress(e.lengthComputable, e.loaded, e.total);
                            };

                            request.onload = function () {
                                if (request.status >= 200 && request.status < 300) {
                                    // the load method accepts either a string (id) or an object
                                    // load(request.responseText);
                                        var event = new CustomEvent("imageUploaded", {detail: request.responseText});
                                    window.dispatchEvent(event);
                              
                                   
                                }  
                            };
                            request.send(formData);
                            return {
                                abort: () => {
                                    request.abort();
                                    abort();
                                },
                            };
                        },
                    },
                    
                    
            });

       },
        methods: {
            
            emitImageUploaded(d){
                let json = JSON.parse(d)
                this.image = json.url
                alert(this.image)
                this.$emit('imageUploaded',{
                    name:this.name,
                    value:json.url,
                })
                 

            },
          
            
            changeVisibility(){
                this.visible = !this.visible
            }
        },
        data() {
            return {
                visible:true,
               myFiles:[],
               image:'',
               

                
            };
        }
    }
</script>
<template>
     <div class="mb-4"  >
      <label
      @click="changeVisibility"
        class="block pl-5 text-gray-600 text-sm font-semibold mb-2"
        for="username"
      >
        {{label}}
      </label>
      <div
        v-show="visible"
        class="bg-gray-100 p-1 appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      >
        
            <file-pond
                name="filepond"
                ref="pond"
                label-idle="Drop files here..."
                v-bind:allow-multiple="true"
                accepted-file-types="image/jpeg,image/jpg, image/png"
               
                v-bind:files="myFiles"
                
            />

            <img 
                class="max-h-40 rounded-md max-w-md"
             :src="image" alt="">
      </div>
       
    </div>
    
</template>