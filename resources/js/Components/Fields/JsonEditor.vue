
<script>
import {JSONEditor} from '@json-editor/json-editor';

    export default {
        
          props:['name','label','initialValue','editorSettings'],
        mounted() {
                this.initEditor()
            if(this.initialValue){
                this.jsonEditor.setValue(this.initialValue)
            }
        },
        
        methods: {
          
             
            emitto(){
                    this.$emit('inputChanged',{
                        name:this.name,
                        value:this.data,
                    })
                 
            },
            initEditor(){
                	 this.jsonEditor =  new JSONEditor(document.getElementById(this.name),this.editorSettings); 
                     	 
				 this.jsonEditor.on('change',() => {
					 	this.data = this.jsonEditor.getValue()
                         this.emitto()
				});

            },
            changeVisibility(){
                this.visible = !this.visible
            }
        },
      
        data() {
            return {
                visible:true,
               jsonEditor:null,
               data: null ,
 
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
            <div :id="name"></div>
      </div>
       
    </div>
    
</template>