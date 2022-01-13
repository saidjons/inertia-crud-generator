<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';

    import {
        TrashIcon,
        PencilIcon
    } from '@/Components/Icons/hero'
    import UpHeading from '@/Components/Tables/TableUI/UpHeading.vue';
    import Heading from '@/Components/Tables/TableUI/Heading.vue';
    import TableRow from '@/Components/Tables/TableUI/TableRow.vue';
    import CellCheckbox from '@/Components/Tables/TableUI/CellCheckbox.vue';
    export default {
        components: {
            AdminLayout,
            TrashIcon,
            PencilIcon,
            UpHeading,
            Heading,
            TableRow,
            CellCheckbox,
        },
        mounted() {

            this.headings.forEach(el => {
                this.showHeadings.push(el.key)
            })
            if (window.localStorage['menuselectedRows']) {
                this.selectedRows = JSON.parse(window.localStorage['menuselectedRows']);
            }
            this.setData()
        },

        methods: {
            deleteItem(data){
                   
                   axios.delete('/admin/menu/'+data, { 
                     headers:{
                         'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': window.csrf,
                            'Authorization': 'Bearer ' + window.token,
                     },
                      id:data,
                     }
                     
                     ) 
                     .then(response=> { 
                         window.notify('Deleted ')
                       this.setData()
                     }) 
                   .catch(error=> {
                    });
             },
            setData() {
                (async () => {
                    const rawResponse = await fetch('/api/menus', {
                        method: 'get',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': window.csrf,
                            'Authorization': 'Bearer ' + window.token,
                        },

                    });
                    const content = await rawResponse.json();
                  
                    this.menus = content.data
                })();
            },
            getObjectKey(value, o) {

                let returnValue = ''
                Object.keys(o).forEach(el => {

                    if (o[el] == value) {

                        returnValue = el

                    }
                })
                return returnValue

            },
            toggleColumn(key) {
                alert(key)
                // Note: All td must have the same class name as the headings key! 
                let columns = document.querySelectorAll('.' + key);
                // console.log(this.$refs[key].classList.contains('hidden'));
                // console.log(this.$refs[key].classList);

                // if (this.$refs[key].classList.contains('hidden')) {
                if (columns[0].classList.contains('hidden')) {
                    columns.forEach(column => {
                        column.classList.remove('hidden');

                    });
                } else {
                    columns.forEach(column => {


                        column.classList.add('hidden');
                    });
                }
            },

            getRowDetail($event, id) {
                let rows = this.selectedRows;

                if (rows.includes(id)) {
                    let index = rows.indexOf(id);
                    rows.splice(index, 1);
                } else {
                    rows.push(id);
                }
            },

            selectAllCheckbox($event) {
                let columns = document.querySelectorAll('.rowCheckbox');

                this.selectedRows = [];

                if ($event.target.checked == true) {
                    columns.forEach(column => {
                        column.checked = true
                        this.selectedRows.push(parseInt(column.name))
                    });
                } else {
                    columns.forEach(column => {
                        column.checked = false
                    });
                    this.selectedRows = [];
                }
            }
        },
        watch: {
        
            showHeadings(n) {
          
                window.localStorage['menuselectedRows'] = JSON.stringify(this.selectedRows)
            }
        },
        data() {
            return {
              
					 

               		headings: [
									 			{ key:'title',cell:'text',visible:true, value: 'title'},

			{ key:'data',cell:'text',visible:true, value: 'data'},

			{ key:'published',cell:'text',visible:true, value: 'published'},

			 

					],
					menus: [],
                selectedRows: [],
                showHeadings: [],

                open: false,



            }
        },
    }
</script>


<template>


    <AdminLayout>

  
      <template v-slot:content>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div>
                <!-- table -->
                <!-- <table-ui :items='menus' :headings='headings'/> -->
                <div class="antialiased sans-serif  ">
                    <div class="container mx-auto   px-4">
                        <h1 class="text-3xl  border-b mb-3">menus</h1>

                        <!-- table start  -->
                        <up-heading :headings='headings' />
                        <!-- heading  -->

                        <div
                            class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
                            style="height: 405px;"
                        >
                            <table
                                class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative"
                            >
                                <heading :headings='headings' />
                                <tbody>

                                    <table-row
                                        v-for="item in menus"
                                        :item='item'
                                        :key="item.id"
                                        :headings='headings'

                                        @deleteItem='deleteItem'
                                    >
                                        <template v-slot:checkbox>
                                            <cell-checkbox :item="item" />
                                        </template>

                                    </table-row>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

                <!-- table ends -->

            </div>
        </div>
  </template>

    </AdminLayout>
</template>