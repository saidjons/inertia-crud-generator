

<script>
 

    export default {
        
          props:['name','label','initialValue'],
        beforeCreate() {
            if(this.initialValue){
                this.editorData = this.initialValue
            }
        },
        beforeCreate() {
                let externalScript = document.createElement('script')
                externalScript.setAttribute('src', '/js/ckeditor.js')
            document.head.appendChild(externalScript)
        },
        mounted() {
               this.imageUploadListener();
               this.inputListener();
           setTimeout(() => {
                this.initEditor()

           }, 1500);
         
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
            // The file loader instance to use during the upload. It sounds scary but do not
            // worry — the loader will be passed into the adapter later on in this guide.
            this.loader = loader;
        }
        // Starts the upload process.
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }
        // Aborts the upload process.
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }
        // Initializes the XMLHttpRequest object using the URL passed to the constructor.
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            xhr.open( 'POST', '/api/upload/image/articleContent', true );
            xhr.setRequestHeader('x-csrf-token', window.csrf);
            xhr.setRequestHeader('Authorization','Bearer '+ window.token);
            xhr.responseType = 'json';
        }
        // Initializes XMLHttpRequest listeners.
        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;
            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;
                 
                // This example assumes the XHR server's "response" object will come with
                // an "error" which has its own "message" that can be passed to reject()
                // in the upload promise.
                //
                // Your integration may handle upload errors in a different way so make sure
                // it is done properly. The reject() function must be called when the upload fails.
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                let evt = new CustomEvent("imageUploaded", {detail: response.url});
                    window.dispatchEvent(evt);
        
               

                // If the upload is successful, resolve the upload promise with an object containing
                // at least the "default" URL, pointing to the image on the server.
                // This URL will be used to display the image in the content. Learn more in the
                // UploadAdapter#upload documentation.
                //  console.info(response.url);
                resolve( {
                    default: response.url
                   
                } );
            } );
            // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
            // properties which are used e.g. to display the upload progress bar in the editor
            // user interface.
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
            
        }
        // Prepares the data and sends the request.
        _sendRequest( file ) {
            // Prepare the form data.
            const data = new FormData();
            data.append( 'image', file );
            // Important note: This is the right place to implement security mechanisms
            // like authentication and CSRF protection. For instance, you can use
            // XMLHttpRequest.setRequestHeader() to set the request headers containing
            // the CSRF token generated earlier by your application.
            // Send the request.
            this.xhr.send( data );
        }
        // ...
    }
    function SimpleUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            // Configure the URL to the upload script in your back-end here!
            return new MyUploadAdapter( loader );
        };
    }
      const editor= ClassicEditor
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
            // Simulate label behavior if textarea had a label
            // if (editor.sourceElement.labels.length > 0) {
            //     editor.sourceElement.labels[0].addEventListener('click', e => editor.editing.view.focus());
            // }
            editor.model.document.on('change:data', (evt, data) => {
     
             let event = new CustomEvent("inputChanged", {detail: editor.getData()});
                    window.dispatchEvent(event);
        
    });

        } )
        .catch( error => {
            console.error( error );
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