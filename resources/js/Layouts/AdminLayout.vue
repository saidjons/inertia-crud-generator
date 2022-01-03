<script>
import SidebarComponent from '@/Components/Sidebar/Sidebar.vue';
export default {
  components: {
    SidebarComponent,
  },
  
}
</script>
<template>
  
    <div class="flex flex-no-wrap">
                    <!-- Sidebar starts -->
                    <!-- Remove class [ hidden ] and replace [ sm:flex ] with [ flex ] -->
                 <!-- sidebar -->
                 <sidebar-component />
                
                    <!-- Sidebar ends -->
                    <!-- Remove class [ h-64 ] when adding a card block -->
                    <div class="container mx-auto py-10 h-64 md:w-4/5 w-11/12 px-6">
                        <!-- Remove class [ border-dashed border-2 border-gray-300 ] to remove dotted border -->
                        <div class="w-full h-full rounded border-dashed border-2 border-gray-300">
                  <slot name="content"></slot>
                        </div>
                    </div>
                </div>

                
</template>
 