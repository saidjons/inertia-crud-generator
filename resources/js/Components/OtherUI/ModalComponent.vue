<script>
import ButtonUI from "@/Components/OtherUI/Button"
export default {
    components: {
        ButtonUI,
    },
    props: {
        btnText: {
            type: String
        },

        action: {
            type: String
        }
    },

    methods: {
        takeAction() {
            this.$emit('action')
        },
        toggleModal() {
            this.showLocal = !this.showLocal
        }
    },
    data() {
        return {
            showLocal: false
        }
    }
}
</script>
<template>
    <!-- Modal toggle -->

    <!-- Main modal -->
    <!-- <button
        class="inline-block  px-3 ring-2 my-2 py-2 ring-blue-400 rounded"
       
    >
       
    </button> -->
    <ButtonUI @btnClicked="toggleModal">
        {{ btnText }}
    </ButtonUI>

    <div v-if="showLocal"
        class=" overflow-scroll fixed   z-50 w-full md:inset-0 h-modal md:h-full flex justify-center items-center"
        :class="showLocal ? '' : 'hidden'">
        <div class="relative p-4 w-full max-w-2xl h-full w-auto  ">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div v-if="$slots['header']"
                    class="flex items-center p-2 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <slot name="header"></slot>
                    <p @click="toggleModal" data-modal-toggle="defaultModal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Close
                    </p>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-2 overflow-y-scroll max-h-screen ">
                    <slot name="body"></slot>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <ButtonUI v-if="action" @btnClicked="takeAction">
                        {{ action }}

                    </ButtonUI>


                    <ButtonUI @btnClicked="toggleModal">
                        Close

                    </ButtonUI>
                </div>
                <div v-if="$slots['footer']"
                    class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600 mb-10">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>
