
<script>
export default {
  props:['name','label','initialValue','id'],

  mounted() {
    if(this.initialValue){
      this.content = this.initialValue
    }
   

  },
  methods: {
    inputChanged(){
      this.$emit('inputChanged',
      {
        id:this.id ?? '',
        name:this.name,
        value:{
          tableName:this.model,
          modelId:this.modelId,
          modelText:this.modelShowCol,
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
       model:'App/Models/',
       modelShowCol:'title',
       modelId:'id',
      visible:false,
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
          <p >Model </p>
          <input v-model="model"  @change="inputChanged" 
          type="text" class="h-6 w-2/3">
        </div>
        <div v-if="visible" name="name" 
          
           class="flex flex-row justify-between">
          <p >Model Id </p>
          <input class='h-6 w-2/3' v-model="modelId"  @change="inputChanged" 
          type="text">
        </div>
        <div v-if="visible" name="name" 
          
           class="flex flex-row justify-between" >
          <p >show col </p>
          <input v-model="modelShowCol"  @change="inputChanged" 
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