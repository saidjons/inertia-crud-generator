
<script>
export default {
  props:['name','label','initialValue','id'],

  mounted() {
    if(this.initialValue){
      this.content = this.initialValue
    }
   this.inputChanged()

  },
  methods: {
    inputChanged(){
      this.$emit('inputChanged',
      {
        id:this.id ?? '',
        name:this.name,
        value:{
          tableName:this.tableName,
          valueField:this.valueField,
          visibleField:this.visibleField,
        },
        
      }
      )
    },
      changeVisibility(){
      this.visible = !this.visible
    },
    
    
    
  },
  data() {
    return {
       tableName:'users',
       visibleField:'title',
       valueField:'id',
      visible:true,
      valueField:null,
      visibleField:null,

    }
  },
}
</script>
<template>
     <div class="  z-40 relative    justify-center    ">
      <label
      @click="changeVisibility"
        class="block   text-gray-600 text-sm font-semibold "
        for="username"
      >
        {{label}}
      </label>

      <div class=" flex flex-col">
        <div v-if="visible" name="name" 
          
           class="flex flex-row justify-between">
          <p >TableName </p>
          <input v-model="tableName"  @change="inputChanged" 
          type="text" class="h-6 w-2/3">
        </div>
        <div v-if="visible" name="name" 
          
           class="flex flex-row justify-between">
          <p >Value col </p>
          <input class='h-6 w-2/3' v-model="valueField"  @change="inputChanged" 
          type="text">
        </div>
        <div v-if="visible" name="name" 
          
           class="flex flex-row justify-between" >
          <p >visible col </p>
          <input v-model="visibleField"  @change="inputChanged" 
          type="text" class="h-6 w-2/3">
        </div>
      </div>
      
     
     


       
    </div>


    <!-- 

      this accepts this object as options props

         catOptions:{
        visibleField:'name',
        valueField:'name',
        items:[
          {
            id:1,
            name:'saidjon',
            

          },
          {
            id:2,
            name:'sava',


          }
        ]
      }



     -->
</template>