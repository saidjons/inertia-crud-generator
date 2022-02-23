 <script>
 import {
     TrashIcon,
     PencilIcon,
     EyeIcon,
     
     } from '@/Components/Icons/hero.jsx';
 import { Inertia } from '@inertiajs/inertia'
 export default {
     props:['id'],
    components: {
        TrashIcon,PencilIcon,EyeIcon,
    },
     mounted() {
         this.setUrl()
     },
     methods:{
         setUrl(){
             let url = this.$page.url
             if (!url.match(/\/$/)) {
                 url + '/'
             }
             this.url = url
         },
         deleteItem(){
             this.$emit('deleteItem',this.id)
         },
         editItem(){
             Inertia.visit(`${this.url}${this.id}/edit`)
             
         },
         viewItem(){
             Inertia.visit(`${this.url}${this.id}`)
             
         },
     data() {
         return { 
             url:null,

         }}
     }
     }
  
 </script>

<template>
             <!-- :class='getObjectKey(item.slug,item)' -->
      	<td class="border-dashed border-t border-gray-200 actions"
								>
								<span class="text-gray-700 px-6 py-3 flex items-center gap-2  "
									> 
                                <button @click='deleteItem'
                                    class="hover:bg-red-300 transparent hover:text-black"
                                >
                                <trash-icon   />
                                
                                </button>
                                <button @click='editItem'
                                    class="hover:bg-yellow-300 transparent hover:text-black"
                                >
                                <pencil-icon />
                                
                                </button>
                                <button @click='viewItem'
                                    class="hover:bg-green-300 transparent hover:text-yellow-500"
                                >
                                <eye-icon />
                                
                                </button>
                               
									</span>
							</td>
</template>