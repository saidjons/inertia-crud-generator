<script>
  export default{
    props:["tabs","currentTab"],
    methods: {
      changeTab(tabId){
        this.$emit('changeTab',{
          id:tabId,
        })
      }
    },
    
  }
</script>
<template>
    <div class="bg-white">
    <h3 class=''>{{ }}</h3>

    <nav class="flex flex-col sm:flex-row text-gray-400">
        <button v-for="tab in tabs" :key="tab"
         
          @click="changeTab(tab.id)"
        class=" py-4 px-6 block hover:text-blue-500 focus:outline-none   font-medium "
          :class="[currentTab==tab.id ?'text-gray-600 border-blue-500 border-b-2 ':'']"
        >
           {{tab.title}}
        </button>
        
         -->
    
    </nav>
</div>
     
     
</template>
