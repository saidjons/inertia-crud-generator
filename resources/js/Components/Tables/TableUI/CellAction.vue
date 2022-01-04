 <script>
 import {TrashIcon,PencilIcon} from '@/Components/Icons/hero.jsx';
 export default {
     props:['id'],
    components: {
        TrashIcon,PencilIcon,
    },
     setup() {
         
     },
     methods:{
         deleteItem(){
             this.$emit('deleteItem',this.id)
         }
     }
 }
 </script>

<template>
             <!-- :class='getObjectKey(item.slug,item)' -->
      	<td class="border-dashed border-t border-gray-200 actions"
								>
								<span class="text-gray-700 px-6 py-3 flex items-center"
									> 
                                <button @click='deleteItem'>
                                <trash-icon   />
                                
                                </button>
                                <button @click='editItem'>
                                <pencil-icon />
                                
                                </button>
                               
									</span>
							</td>
</template>