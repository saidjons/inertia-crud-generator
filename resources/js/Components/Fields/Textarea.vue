
<script>
export default {
  props:['name','label','initialValue','action'],

  mounted() {
    if(this.initialValue){
      this.content = this.initialValue
    }
     if(this.action){
      this.showBtn = true
    }

  },
  methods: {
    inputChanged(){
      this.$emit('inputChanged',
      {
        value:this.content,
        name:this.name,
      }
      )
    },
      changeVisibility(){
      this.visible = !this.visible
  }
  },
  data() {
    return {
      showBtn:false,
      content:null,
      visible:true,

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

    
<div class="flex flex-row">

        <textarea
        v-show="visible"
        :name="name"
          v-model="content"
          @change="inputChanged"
        rows="4"
        cols="50"
        class="bg-gray-100 p-1 appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
         
        type="text">
      </textarea>

      <div v-if="showBtn" class="rounded-l-lg border border-gray-900 bg-transparent bg-green-200 text-sm font-medium px-4 py-2 text-gray-900 hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white inline-flex items-center">
      <button
            @click="$emit('btnClicked')"
      >Action</button>
      </div>
</div>

       
    </div>
</template>