<script>
import { Inertia } from '@inertiajs/inertia'
export default {
  props:['item'],
  methods: {
    showSubs(){
      if(this.item.nested){
      this.openSubs = !this.openSubs
      }else{
        Inertia.visit(this.item.link, { method: 'get' })
      }
    }
  },
  data() {
    return{ 
      openSubs:false,
    }
  }
  
}
</script>
<template>
     <li class="flex w-full justify-between   cursor-pointer items-center mb-6">
        <a href="javascript:void(0)" 
          @click="showSubs"
         class="flex items-center focus:outline-none focus:ring-2 focus:ring-white w-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z"></path>
                <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                <rect x="14" y="14" width="6" height="6" rx="1"></rect>
            </svg>
            <span class="text-sm ml-2">{{item.title}}</span>
        </a>
        <div v-if="item.badgeNumber" class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">{{item.badgeNumber}}</div>
    </li>
        <div v-show="openSubs" class="bg-white pl-2 mb-2   capitalize text-gray-500 font-semibold">
            <template v-for="(sub ,subIndex) in item.subs" :key="subIndex" >
             <li class="flex w-full justify-between text-gray-800 cursor-pointer items-center mb-2 hover:bg-green-200 ">

              <a  :href="sub.link" class="  my-1 cursor-pointer items-center w-full  ">
                {{sub.title}}
              </a>
              <div v-if="item.badgeNumber" class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">{{sub.badgeNumber}}</div>
             </li>
            </template >
        </div>
                                
</template>