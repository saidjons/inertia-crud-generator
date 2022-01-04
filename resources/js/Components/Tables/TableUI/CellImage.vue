 <script>
 export default {
     props:['text'],

     setup() {
         
     },
 }
 </script>

<template>
             <!-- :class='getObjectKey(item.slug,item)' -->
       <td class="border-dashed border-t border-gray-200 image"><span
               class="text-gray-700 px-6 py-3 flex items-center"
           >
           <img 
            class="h-25  w-20"
           :src="text" alt="">
           
       </span></td>
                 

</template>