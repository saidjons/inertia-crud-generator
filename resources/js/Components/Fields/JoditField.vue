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
              <jodit-editor v-model="editorData"></jodit-editor>
      </div>
       
    </div>
</template>

<script>
 import {JoditEditor} from 'jodit-vue3'
import 'jodit/build/jodit.min.css'

    export default {
          props:['name','label','content'],
          components:{
               JoditEditor,
          },
        beforeMount(){
            if (this.content) {
            
                this.editorData = this.content
            }
         
        },
        mounted(){
             // this is for keditor to image upload 
          // plugins/SimpleUploadAdapter uses it
          window.token = this.$page.props.user.token
          window.csrf = this.$page.props.csrf
        },
        methods: {
            changeVisibility(){
                this.visible = !this.visible
            }
        },
        watch: {
            editorData(n,old){
                   this.$emit('inputChanged',{
                        name:this.name,
                        value:this.editorData,
                    })
            }
        },
        data() {
            return {
                  visible:true,
                editorData: null,

            };
        }
    }
</script>
