 <script>
 export default {
     props:['item'],

     setup() {
         
     },
     methods:{
         rowChecked(id){
          
        },
     }
 }
 </script>

<template>
    <td class="border-dashed border-t border-gray-200 px-3">
             <label
                 class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer"
             >
                 <input
                     type="checkbox"
                     class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline"
                     :value="item.id"
                     :name="item.id"
                     
                      @click="rowChecked($event,item.id)"
                 >
             </label>
         </td>
</template>