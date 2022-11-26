
<script>
export default {
  props:['name','id','fieldType','label','initialValue','action'],
  beforeMount() {
    this.unique_id=Math.random().toString().substr(2, 8)
  },
  mounted() {
    if(this.initialValue){
      this.content = true
    }
    if(this.action){
      this.showBtn = true
    }
    this.inputChanged()

  },
  methods: {
      getID(){
      return this.unique_id
    },
    changeVisibility(){
      this.visible = !this.visible
    },
    inputChanged(){
      this.$emit('inputChanged',
      {
        id:this.id??'',
        value:this.content,
        name:this.name,
      }
      )
    }
  },
  data() {
    return {
      content:false,
      visible:true,
      showBtn:false,
      unique_id:null,

    }
  },
}
</script>
<template>
     <div class="mb-4">
      <label
        @click='changeVisibility'
        class="block pl-5 text-gray-600 text-sm font-semibold mb-2"
        for="username"
      >
        {{label}}
      </label>
<!-- checkbox starts  -->
<div class="flex justify-center mt-3">
 
    <div 
       v-show="visible"

    class="form-check">
      <input
      :id="getID()"
         :name="getID()"
      v-model="content"
        @change="inputChanged"

       class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox"    :checked='initialValue'>
      <label class="form-check-label inline-block text-gray-800" :for="getID()">
        {{label}}
      </label>
    </div>
  
</div>

<!-- checkbox ends  -->
       
    </div>
</template>