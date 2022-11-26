<template>
    
    <button 
    @click="emit"
    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
        <slot></slot>

</button>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        },
        methods: {
            emit() {
                this.$emit('btnClicked')
            }
        }
    })
</script>
