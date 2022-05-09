<template>
    

    <admin-layout>
     
    <template v-slot:content>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <!-- <generator-create  /> -->
            <!-- generator starts -->
             <div class="  justify-center text-left mx-5 ">
      <div class="">
        <input-field name="tableName" label="Enter Table Name to Generate" @inputChanged='setTableNameInput' action="Get Table" 
        @btnClicked='getTableColumns'/>
      </div>

      
  <div
     v-for="col in iterateTableColumNames()" :key="col"
   class="flex flex-row justify-evenly text-gray-500 
        border-2 border-b-green-400 
   ">
        
    
      <h3 >{{col}}</h3>
      <h3 >{{ dbTableColumns[col] }}</h3>
      <options-field :name="col"  :options='catOptions' label='Select Field' 
          @inputChanged='setColumns' :id="col" :initialValue="dbTableColumns[col]"
        />
       
        <relation-field  
          v-if="isRelationField(col)"
          :name="col" 
          label="Relation data  "
          :id="col"
          @inputChanged='setRelationForColumn'
         />
          <json-editor-component 
            v-if="isOptionField(col)"
				    :name="col" 
            :id="col"
					 label='Add Options '
					 @inputChanged='setOptionForColumn'
					 editorSettings='optionField'
				 />

 

       


  </div><!-- end wrapper row -->
   


    <!-- buttons start  -->
      <div class="flex items-center justify-center my-3 ">
      <button 
        @click="cutFields"
      class="bg-gray-300 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Get Ready
      </button>
      <button 
        @click="generate"
      class=" bg-green-400   text-white font-bold py-2 px-4 ml-2 rounded focus:outline-none focus:shadow-outlinetext-gray-500 hover:text-white hover:bg-gray-700"  href="#">
        Generate
      </button>
    </div>
    <!-- buttons end -->
 
</div>
            <!-- generator end -->

        </div>
    </template>

    </admin-layout>
</template>

<script>
 
 import TextareaField from '@/Components/Fields/Textarea';
 
export default {
     
    components: {
      TextareaField,
    },
     methods: {
   
    getTableColumns(){
      axios.post('/admin/generator/get-table', { 
      tableName: this.tableName,
        },{
           'X-CSRF-TOKEN' :this.$page.props.csrf,
        'Authorization' : 'Bearer '+ this.$page.props.token,
        }) 
        .then(res=> { 
          this.processResponseColumns(res)
           
        }) 
      .catch(error=> {
       });
    
      
    },
    processResponseColumns(r){
          if(r.status == 200){
             window.notify( r.data.message)
           
            this.dbTableColumns = r.data.columns
           }else{

              window.notify( r.data.message,'warning')
           }
    },
    setTableNameInput(d){
      this.tableName = d.value

    },
    iterateTableColumNames(){
      return Object.keys(this.dbTableColumns)
    },
    isRelationField(d){

      let r = false
      this.postColumns.forEach(el=>{
       
        if (d == el.fieldName && el.className == 'RelationField') {
          r = true
        }
        
      })
      return r 
    },
    isOptionField(d){
      
      let r = false
      this.postColumns.forEach(el=>{
        if (d == el.fieldName && el.className == 'OptionField') {
          r = true
        }
        
      })
      return r 
    },
    setColumns(data){
      

        this.dbTableColumns[data.name] = data.value
       

    },
    setPostColumns(){
      this.postColumns = []
      let keys = this.iterateTableColumNames()
      keys.forEach(el => {
          this.postColumns[el] = this.dbTableColumns[el] 
        this.postColumns.push({
           fieldName:el,
          className:this.dbTableColumns[el],
          relation:null,
        })
        
      });
       
    },
    setOptionForColumn(d){
     
        let id = null
       this.postColumns.forEach((el,i)=>{
         if (el.fieldName == d.name) {
           id = i
              
          } 
       })

       if(id){
         this.postColumns[id].option = JSON.stringify(d.value)
       }
    },
    setRelationForColumn(d){
     
        let id = null
       this.postColumns.forEach((el,i)=>{
         if (el.fieldName == d.name) {
           id = i
            
          } 
       })

       if(id){
       this.postColumns[id].relation = d.value
       }
    },
    setOptionForColumn(d){
     

       this.postColumns.forEach((el,i)=>{
         if (el.fieldName == d.name) {
            this.postColumns[i].option = JSON.stringify(d.value)

         } 
       })
    },
     
    generate(){
      this.postColumns = this.postColumns.filter(function(el){
        return el.fieldName!='' &&el.className!=null
      })

        axios.post('/admin/crud/generator', { 
        table:this.tableName,
        columns:this.postColumns,
          },{
            'X-CSRF-TOKEN': this.$page.props.csrf,
            'Authorization':'Bearer '+ this.$page.props.token
            }
          ) 
          .then(res=> { 
            if(res.status == 200 ){

              if (res.data.messages) {
                 for (let index = 0; index < res.data.messages.length; index++) {
                   const element = res.data.messages[index];
                  window.notify(element.message)
                   
                 }

                 
              }
            }else{
              window.notify(res.data.message,'warning')
            }
          }) 
        .catch(error=> {
          

         });
    },
    cutFields(){
       this.filterColumns()
       this.postColumns = []
       this.setPostColumns()
    },
    filterColumns(){
      let keys = this.iterateTableColumNames()
      let cols = {}
      keys.forEach(el => {
        if(this.dbTableColumns[el] != 'dismiss'){
          cols[el] = this.dbTableColumns[el] 

        }
      });

      this.dbTableColumns = cols
      
    }
  },
    data() {
    return {
       
      tableName:null,
      postColumns:[],
      dbTableColumns:{},
      catOptions:{
        visibleField:'name',
        valueField:'className',
        items:[
        {
        name:'checkbox',
        className:'CheckboxField',


        },
        {
        name:'ckeditor',
        className:'CkeditorField',


        },
        {
        name:'date',
        className:'DateField',


        },
        {
        name:'relation',
        className:'RelationField',


        },
        {
        name:'dismiss',
        className:'',


        },
        {
        name:'file',
        className:'FileField',


        },
        {
        name:'imageUpload',
        className:'ImageUploadField',


        },
        {
        name:'number',
        className:'NumberField',


        },
        {
        name:'textarea',
        className:'TextareaField',


        },
        {
        name:'text',
        className:'TextField',


        },
        {
        name:'option',
        className:'OptionField',


        },
      ],
        
      },//end of catOptions

    }
  },

    
}
</script>
