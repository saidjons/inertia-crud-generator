<script>
import SidebarItem from './SidebarItem.vue';
export default {
    components:{
        SidebarItem,
    },
    mounted() {
        this.setData()
    },
     methods: {
         setData() {
             this.errors = null
			 window.axios.post('/admin/getMenus',{
				headers: { 
					'Accept':'application/json',
					'X-CSRF-TOKEN' : window.csrf,
                    'Authorization' : 'Bearer ' + window.token
			
			} ,
					 			 
 			 menuName : 'admin' ,
 
			}) 
				.then(res=> { 
				res.data.data.forEach(el => {
                    this.sidebarItems.push(JSON.parse(el.data))
                });	 
			  }) 
			.catch(error=> {
			 

			 });
            },
         sidebarHandler(){
             this.hidden = !this.hidden
         },
     },
     data() {
         return {
             hidden:false,
              sidebarItems:[
              ],
         }
     }
}
</script>
<template>

 <!-- Sidebar starts  start
    to hide  .hidden flex
    to show sm:flex  
 
 -->
                    <!-- Remove class [ hidden ] and replace [ sm:flex ] with [ flex ] -->
       <div style="min-height: 716px" class="w-64   sm:relative     md:h-full flex-col justify-between     "
       
       :class="[hidden==true ? 'hidden flex':'sm:flex ']"
       >
                        <div class="px-8">
                            <div class="h-16 w-full flex items-center">
                              <img src="" alt=" Inertia Crud generator">
                            </div>
                            <ul class="mt-12">
                                <template  v-for="(item,itemIndex) in sidebarItems" :key="itemIndex">
                                <sidebar-item  :item='item'/>
                                </template >
                            </ul>
                            <!-- <div class="flex justify-center mt-48 mb-4 w-full">
                                <div class="relative">
                                    <div class="text-gray-300 absolute ml-4 inset-0 m-auto w-4 h-4">
                                      <img src="" alt="Search">
                                    </div>
                                    <input class=" focus:outline-none focus:ring-1 focus:ring-gray-100 rounded w-full text-sm text-gray-300 placeholder-gray-400 bg-gray-100 pl-10 py-2" type="text" placeholder="Search">
                                </div>
                            </div> -->
                        </div>
                        <!-- sidebar bottom -->
        </div>


        <!-- second part start -->
        <!-- sidebar toggle button -->
            <div class="w-64 z-40 absolute bg-gray-800 shadow md:h-full flex-col justify-between lg:hidden transition duration-150 ease-in-out" id="mobile-nav" style="transform: translateX(-260px);">
            <button aria-label="toggle sidebar" id="openSideBar" class="h-10 w-10 bg-gray-800 absolute right-0 mt-16 -mr-10 flex items-center shadow rounded-tr rounded-br justify-center cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 rounded focus:ring-gray-800" @click="sidebarHandler">
                <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg7.svg" alt="toggler">
            </button>
                        <button aria-label="Close sidebar" id="closeSideBar" class="hidden h-10 w-10 bg-gray-800 absolute right-0 mt-16 -mr-10 flex items-center shadow rounded-tr rounded-br justify-center cursor-pointer text-white" @click="sidebarHandler">
                          <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg8.svg" alt="cross">
                        </button>
                        <div class="px-8">
                            <div class="h-16 w-full flex items-center">
                                <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg1.svg" alt="Logo">
                            </div>
                           
                         
                        </div>
                      
                    </div>
                    <!-- end sidebar toggle button -->
        <!-- second part end -->
</template>