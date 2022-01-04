 <script>
 export default {
     props:['text'],

     setup() {
         
     },
 }
 </script>

<template>
             <!-- :class='getObjectKey(item.slug,item)' -->
      <td
             class='border-dashed border-t border-gray-200 text-green-800'
         ><span class='text-gray-700 px-6 py-3 flex items-center'>{{ text }}</span>
         </td>
</template>