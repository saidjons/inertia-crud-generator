
<script>
 import VueMultiselect from 'vue-multiselect'
export default {
  props:['name','fieldType','label','initialValue','action'],
  components:{
    VueMultiselect,
  },
     
  mounted() {
    if(this.initialValue){
 
      this.content = this.initialValue
    }
    if(this.action){
      this.showBtn = true
    }
    
  },
  watch: {
    initialValue(n,o){
       this.content = n
    },
    content(n){
       
      this.inputChanged()
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
      
      visible:true,
      showBtn:false,
      
      content:[],
       options: [
        { title: 'Vue.js', value: 'JavaScript' },
        { title: 'Rails', value: 'Rails' },
        { title: 'Sinatra', value: 'Ruby' },
        { title: 'Laravel', value: 'PHP' },
        { title: 'Phoenix', value: 'Elixir' }
      ],



    }
  },
}
</script>
<template>
     <div class="mb-4">
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

      

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
      <!-- <input 
     
      :name="name"
      v-model="content"
        @change="inputChanged"
      :type="fieldType"
        class="bg-gray-100 p-1 appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      > -->
       <VueMultiselect
        v-model="content"
        :options="options"
        :multiple="true"
        :close-on-select="true"
        :placeholder="label"
        label="title"
        track-by="value"
        max-height="400"
        hideSelected='true'
      />


      <button v-if="showBtn" 
        @click="$emit('btnClicked')"
      class="  bg-green-300   mx-2 w-1/5   rounded-sm
        
        ">
        {{action}}
      </button>
      </div>
       
    </div>
</template>
