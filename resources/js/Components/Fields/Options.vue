
<script>
export default {
  props:['name','label','options','initialValue','id'],

  mounted() {
    if(this.initialValue){
      this.content = this.initialValue
    }
    if(this.options.valueField){
      this.valueField = this.options.valueField
    }
    if(this.options.visibleField){
      this.visibleField = this.options.visibleField
    }

  },
  methods: {
    inputChanged(){
      this.$emit('inputChanged',
      {
        id:this.id ?? '',
        name:this.name,
        value:this.content,
        
      }
      )
    },
      changeVisibility(){
      this.visible = !this.visible
    },
    getItems(){
      return this.options.items
    },
    getValue(index){
      return this.options.items[index][this.valueField]
    },
    getVisibleText(index){
      return this.options.items[index][this.visibleField]
    }
  },
  data() {
    return {
      content:null,
      visible:true,
      valueField:null,
      visibleField:null,

    }
  },
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

         <select 
          v-show="visible"
          :name="name"
          v-model="content"
          @change="inputChanged"
           class="bg-gray-100 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"

        >
     <option 
        v-for="(item,i) in options.items" :key="i"
      :value="getValue(i)" > {{getVisibleText(i)}}  </option>
     
    

   </select>


       
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