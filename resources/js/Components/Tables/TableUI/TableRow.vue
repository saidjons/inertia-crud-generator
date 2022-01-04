 <script>
 import CellCheckbox from './CellCheckbox.vue';
 import CellAction from './CellAction.vue';
 import CellText from './CellText.vue';
 import CellNumber from './CellNumber.vue';
 import CellImage from './CellImage.vue';
     export default {
         props: ['item','headings'],
        components: {
            CellCheckbox,
            CellText,
            CellAction,
            CellNumber,
            CellImage,

        },
         setup() {

         },
         methods: {
             deleteItem(data){
                    
                  this.$emit('deleteItem',data)
             },
             getObjectKey(value,o){

			 let returnValue = ''
				  Object.keys(o).forEach(el=>{
						 
						 if(o[el] == value){
							  
								returnValue = el
							  
						 }
					})
					return returnValue
			 
			 },
         },
     }
 </script>

 <template>
     <tr
      
     >
         <slot name="checkbox"></slot>
     

         <!-- tableColumnsTemplate   -->
       <template v-for="(heading,key ) in headings" :key="key" :text='item[heading.value]'
      
       >
       <template 
          v-if="heading.visible==true"
          >

       

            <template v-if="heading.cell=='string'">
                <cell-text  :text='item[heading.value]'/>
            </template>
            <template v-if="heading.cell=='number'">
                <cell-number  :text='item[heading.value]'/>
            </template>
             <template v-if="heading.cell=='image'">
                <cell-image  :text='item[heading.value]'/>
                <!-- {{item[heading.value]}} -->
            </template>
       </template>

        </template>
         
      
         <!-- <td
             class='border-dashed border-t border-gray-200'
             :class='getObjectKey(item.body,item)'
         ><span
                 class='text-gray-700 px-6 py-3 flex items-center'>{{item.body.substring(0,100) }}</span>
         </td>
         -->
        
       

       <!-- action td -->
       <cell-action  :id='item.id' 
            @deleteItem='deleteItem'
        />
     </tr>
 </template>