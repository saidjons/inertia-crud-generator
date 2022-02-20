

<script>
 

    export default {
        
          props:['name','label','initialValue'],
      
        beforeCreate() {
                let externalScript = document.createElement('script')
                externalScript.setAttribute('src', '/js/ckeditor.js')
            document.head.appendChild(externalScript)
        
        
        },
        mounted() {
      window.token = this.$page.props.user.token
            window.csrf = this.$page.props.csrf
               this.imageUploadListener();
               this.inputListener();
             setTimeout(() => {
                this.initEditor()
             

           }, 0);
              
           
           
        },
        
        
        methods: {
            imageUploadListener(){
                 window.addEventListener("imageUploaded", function(evt) {
                     
                });
            },
            inputListener(){
                 window.addEventListener("inputChanged", (evt)=> {
                    this.$emit('inputChanged',{
                        name:this.name,
                        value:evt.detail,
                    })
                });
            },
            initEditor(){
                  class MyUploadAdapter {
        constructor( loader ) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
            xhr.open( 'POST', '/admin/upload/article-image', true );
            xhr.setRequestHeader('x-csrf-token', window.csrf);
            xhr.setRequestHeader('Authorization','Bearer '+ window.token);
            xhr.responseType = 'json';
        }
        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;
            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                let evt = new CustomEvent("imageUploaded", {detail: response.url});
                    window.dispatchEvent(evt);
                resolve( {
                    default: response.url
                   
                } );
            } );
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
            
        }
        _sendRequest( file ) {
            // Prepare the form data.
            const data = new FormData();
            data.append( 'image', file );
            this.xhr.send( data );
        }
        // ...
    }
    function SimpleUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            return new MyUploadAdapter( loader );
        };
    }
      window.ckeditor= ClassicEditor
        .create( document.querySelector( '#editor' ), {
              

            codeBlock: {
            languages: [
                { language: 'css', label: 'CSS' },
                { language: 'html', label: 'HTML' }
            ]
        },
            extraPlugins: [ SimpleUploadAdapterPlugin ],
        } )
        .then( editor => {

            // editor.getData('this sset')
            editor.model.document.on('change:data', (evt, data) => {
     
             let event = new CustomEvent("inputChanged", {detail: editor.getData()});
                    window.dispatchEvent(event);
        
            });

        } )
        
        .catch( error => {
            
        } );
            },
          
            
            changeVisibility(){
                this.visible = !this.visible
            }
        },
      
        data() {
            return {
                visible:true,
               editor:null,
                editorData: ' ',
               

                editorConfig: {
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
            <div id="editor"></div>
      </div>
       
    </div>
    
</template>