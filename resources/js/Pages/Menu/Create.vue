
<script>
import getEditorSettings from '@/plugins/getEditorSettings';
import stringToSlug from '@/plugins/stringToSlug';

export default {
    props:['token'],
    components: {
		stringToSlug,
    },
     	mounted() {
			 
        
	 
	},
  methods: {
		getEditorSettings(d){
			return getEditorSettings(d)
		},
	 
				setErrors(d){
				 
						let errors = this.flattenObject(d)
					let values = Object.values(errors)
					values = [...values]
			 			this.errors = values 
				},
				 flattenObject(ob) {
					var toReturn = {};

					for (var i in ob) {
							if (!ob.hasOwnProperty(i)) continue;

							if ((typeof ob[i]) == 'object' && ob[i] !== null) {
									var flatObject = this.flattenObject(ob[i]);
									for (var x in flatObject) {
											if (!flatObject.hasOwnProperty(x)) continue;

											toReturn[i + '.' + x] = flatObject[x];
									}
							} else {
									toReturn[i] = ob[i];
							}
					}
					return toReturn;
			},

				
							 
   			setRole(data){

     			this.title = data.value 

     			},
			 
   			setData(data){

     			this.data = JSON.stringify(data.value) 

     			},
			 
   			setPublished(data){

     			this.published = data.value 

     			},

     
    store(){
			this.errors = null
			 window.axios.post('/api/menus',{
				headers: { 
					'Accept':'application/json',
				'X-CSRF-TOKEN' : this.$page.props.csrf,
      'Authorization' : 'Bearer ' + this.$page.props.user.token
			
			} ,
					 			 role : this.role ,
 			 data : this.data ,
 			 published : this.published ,
 
			}) 
				.then(res=> { 
					console.log(res);
					   if (res.status ==200) {
						 window.notify(res.message)
					 }else{
						 this.setErrors(res.data)
					 }
			  }) 
			.catch(error=> {
				this.errors = Object.values(this.flattenObject(error.response.data.errors));
				if(this.errors){
					window.notify(this.errors[0],'tip')

				}else{
					let model = window.location.pathname.split('/')[2]
					window.notify(`Please set up ${model} API  with Infyom.api:scaffold`,'warning')
				}

			 });
    }
   
  },
  
  
  data() {
    return {
			menuEditor:null,
			role : null ,
 			 data : null ,
 			 published : null ,
 
			errors:[]
    }
  },
}
</script>


<template>

    <AdminLayout>
         <template v-slot:content>
     

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="w-4/5 justify-center text-left mx-5 ">
  <div class="bg-white rounded px-2 pt-6 pb-8 mb-4">
	<template v-if='errors' v-for='error in errors' :key='error'>
	<error-message :error='error' />
	</template>
 
	 				 <input-field  name='role' label='Enter role'  fieldType='text'  @inputChanged='setRole'/> 
 			 <!-- <textarea-field name='data' label='Enter data' @inputChanged='setData' />  -->
			 	<json-editor-component 
				 	name='data' 
					 label='Set menu in json format'
					 @inputChanged='setData'
					 :editorSettings='getEditorSettings("menu")'
				 />
				
			 <checkbox-field  name='published' label=' Is published'
			 	initialValue='true'
			      @inputChanged='setPublished'/> 
 

  </div><!-- end of wrapper-->

  <!-- buttons start -->
      <div class="flex items-center justify-between">
      <button 
            @click='store'
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Create post
      </button>
      <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
        cancel
      </a>
    </div>
  <!-- buttons end -->
 
</div>

        </div>
  </template>

    </AdminLayout>
</template>
