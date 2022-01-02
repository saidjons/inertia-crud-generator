
<script>
export default {
  props:['name','fieldType','label','initalValue','action'],
  mounted() {
    if(this.initialValue){
      this.content = true
    }
    if(this.action){
      this.showBtn = true
    }

  },
  methods: {
    changeVisibility(){
      this.visible = !this.visible
    },
    inputChanged(){
      this.$emit('inputChanged',
      {
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

      <div class="flex flex-row justify-between"
       v-show="visible"
        >
      <input 
     
      :name="name"
      v-model="content"
        @change="inputChanged"
      type="checkbox"
        class="bg-gray-100 p-1 appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      >
      <button v-if="showBtn" 
        @click="$emit('btnClicked')"
      class="  bg-green-300   mx-2 w-1/5   rounded-sm
        
        ">
        {{action}}
      </button>
      </div>
       
    </div>
</template>