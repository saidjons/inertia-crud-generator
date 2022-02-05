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
      <options-field name="category"  :options='catOptions' label='Select Field' 
          @inputChanged='setColumns' :id="col" :initialValue="dbTableColumns[col]"
        />
       
        <relation-field  
          v-if="isRelationField(col)"
          :name="col" 
          label="Relation data  "
          :id="col"
          @inputChanged='setRelationForColumn'
         />

       


  </div><!-- end wrapper row -->
   


    <!-- buttons start  -->
      <div class="flex items-center justify-center my-3 ">
      <button 
        @click="cutFields"
      class="bg-gray-300 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        cutFields 
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
 
 
export default {
     
    components: {
      
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
       
        if (d == el.fieldName && el.fieldType == 'relation') {
          r = true
        }
        
      })
      return r 
    },
    setColumns(data){
      
      
        this.dbTableColumns[data.id] = data.value
    },
    setPostColumns(){
      this.postColumns = []
      let keys = this.iterateTableColumNames()
      keys.forEach(el => {
          this.postColumns[el] = this.dbTableColumns[el] 
        this.postColumns.push({
           fieldName:el,
          fieldType:this.dbTableColumns[el],
          relation:null,
        })
        
      });
       
    },
    setRelationForColumn(d){
     

       this.postColumns.forEach((el,i)=>{
         if (el.fieldName == d.name) {
            this.postColumns[i].relation = d.value
             
         } 
       })
    },
     
    generate(){
      
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
              console.log(res.data);

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
        valueField:'name',
        items:[
        {
        name:'checkbox',

        },
        {
        name:'ckeditor',

        },
        {
        name:'date',

        },
        {
        name:'relation',

        },
        {
        name:'dismiss',

        },
        {
        name:'file',

        },
        {
        name:'imageUpload',

        },
        {
        name:'number',

        },
        {
        name:'textarea',

        },
        {
        name:'text',

        },
        {
        name:'options',

        },
      ],
        
      },//end of catOptions

    }
  },

    
}
</script>
