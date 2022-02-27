<template>
    <div>
        <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
    </div>
</template>

<script>
import CKEditor from '@ckeditor/ckeditor5-vue';

    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import {SimpleUploadAdapterPlugin} from '@/plugins/SimpleUploadAdapter'

    export default {
          props:['name','label','content'],
          components:{
              CKEditor
          },
        beforeMount(){
            if (this.content) {
            
                this.editorData = this.content
            }
         
        },
        mounted(){
            window.token = this.$page.props.user.token
            window.csrf = this.$page.props.csrf
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
                editor: ClassicEditor,
                editorData: null,
                editorConfig: {
                    // The configuration of the editor.
                       codeBlock: {
                      languages: [
                          { language: 'css', label: 'CSS' },
                          { language: 'html', label: 'HTML' }
                      ]
                  },
                   extraPlugins: [ SimpleUploadAdapterPlugin ],
                }
            };
        }
    }
</script>