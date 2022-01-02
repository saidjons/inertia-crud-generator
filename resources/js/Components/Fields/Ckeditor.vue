

<script>
//    import SimpleUploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter';

    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        
          props:['name','label','initialValue'],
        beforeCreate() {
            if(this.initialValue){
                this.editorData = this.initialValue
            }
        },
        methods: {
            inputChanged(){
                console.log(this.editorData);

                this.$emit('inputChanged',{
                    name:this.name,
                    value:this.editorData,
                })

            },
            
            changeVisibility(){
                this.visible = !this.visible
            }
        },
        watch: {
            editorData:function(val){
                console.info();
                 this.inputChanged()
            }
        },
        data() {
            return {
                visible:true,
                editor: ClassicEditor,
                editorData: ' ',
               

                editorConfig: {
               
                toolbar: [ 'heading', 'image', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'insertTable' ],                          
                uploadUrl: 'http://example.com',

                    // Enable the XMLHttpRequest.withCredentials property.
                    withCredentials: true,

                    // Headers sent along with the XMLHttpRequest to the upload server.
                    headers: {
                        'X-CSRF-TOKEN': 'CSRF-Token',
                        Authorization: 'Bearer <JSON Web Token>'
                    }
                }
            };
        }
    }
</script>
<template>
     <div class="mb-4">
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
        <ckeditor
         :editor="editor" v-model="editorData" :config="editorConfig"
            @change="inputChanged"
        ></ckeditor>
      </div>
       
    </div>
    
</template>