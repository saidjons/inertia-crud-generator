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
     setup() {
         
     },
     methods:{
         deleteItem(){
             this.$emit('deleteItem',this.id)
         },
         editItem(){
             Inertia.visit(`/admin/category/${this.id}/edit`)
             
         },
         viewItem(){
             Inertia.visit(`/admin/category/${this.id}`)
             
         }
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