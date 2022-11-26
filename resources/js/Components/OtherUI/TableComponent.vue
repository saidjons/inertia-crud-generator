<script>
  

</script>
<template>
 
<section class="antialiased bg-gray-100 text-gray-600  px-4"  >
    <div class="flex flex-col justify-center h-full">
        <!-- Table -->
        <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
                <div class="font-semibold text-gray-800">
                  <slot name="header"></slot>
                </div>
            </header>

            <div class="overflow-x-auto xs:p-3 py-5">
                <table class="table-auto w-full">
                    <!-- <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <th></th>
                            <th class="p-2">
                                <div class="font-semibold text-left">Product Name</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-left">Quantity</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-left">Total</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Action</div>
                            </th>
                        </tr>
                    </thead> 
                -->

                    <tbody class="text-sm divide-y divide-gray-100">
                        <!-- record 1 -->
                        <tr>
                            <!-- <td class="p-2">
                                <input type="checkbox" class="w-5 h-5" value="id-1"
                                    @click="toggleCheckbox($el, 2890.66)" />
                            </td> -->
                            <slot name="data" ></slot>

                           
                       
                        </tr>

                     
                   
                    </tbody>
                </table>
            </div>

            <!-- total amount -->
            <!-- <div class="flex justify-end font-bold space-x-4 text-2xl border-t border-gray-100 px-5 py-4">
                <div>Total</div>
                <div class="text-blue-600">RM <span x-text="total.toFixed(2)"></span></div>
            </div> -->

            
        </div>
    </div>
</section>

     
</template>

