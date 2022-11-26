 <script>
 export default {
     props:['text'],

     created() {
          
     },
 }
 </script>

<template>
             <!-- :class='getObjectKey(item.slug,item)' -->
      <td
             class='border-dashed border-t border-gray-200'
         >
           <span  v-if="typeof text == 'string'" class='text-gray-700 px-6 py-3 flex items-center'>{{ text.substring(0,100) }}</span>

         <span v-else class='text-gray-700 px-6 py-3 flex items-center'>{{ text }}</span>

       
         </td>
</template>