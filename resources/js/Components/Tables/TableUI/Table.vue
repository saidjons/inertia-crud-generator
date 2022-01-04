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
        <div class="container mx-auto   px-4">
            <h1 class="text-3xl  border-b mb-3">{{tableName}}</h1>

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