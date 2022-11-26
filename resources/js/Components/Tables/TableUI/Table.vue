<script>
    import UpHeading from './UpHeading.vue';
    import Heading from './Heading.vue';
    import TableRow from './TableRow.vue';
import CellCheckbox from './CellCheckbox.vue';
    export default {
        props: ['items', 'headings'],
        components: {
            UpHeading,
            Heading,
            TableRow,
            CellCheckbox,
        },

        setup() {

        },
    }
</script>

<template>
    <div class="antialiased sans-serif  ">
        <div class="">
            <h1 class="text-3xl  border-b mb-3">{{tableName}}</h1>

            <!-- table start  -->
            <!-- <up-heading :headings='headings' /> -->
            <!-- heading  -->

            <div
                class="  bg-white rounded-lg shadow  "
                
            >
                <table
                    class="border-collapse table-auto   whitespace-no-wrap bg-white table-striped "
                >
                    <heading :headings='headings' />
                    <tbody>
                   
                        <table-row  v-for="item in items" :item='item' :key="item.id" 
                          :headings='headings'
                        >
                          <template v-slot:checkbox >
                            <cell-checkbox :item="item" />
                          </template>

                        </table-row>

                    </tbody>
                </table>
            </div>
        </div>


    </div>
</template>