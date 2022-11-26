<script>
export default {
     props: {
        downArrowColor:{
            type:String,
            default:''
        }
    },
    data () {
        return {
            active: false
        }
    }
}
</script>
<template>
    <div class="container mx-auto blue-bg border-grey-light border ">
        <div class="tab__header">
            <a
                href="#"
                class="tab__link p-4 block bg-blue-dark hover:bg-blue-darker no-underline   border-b-2 border-white flex justify-between"
                @click.prevent="active = !active"
            >
              <slot name="title"> </slot> 
                <span class="down-Arrow " :class="downArrowColor" v-show="!active">&#9660;</span>
                <span class="up-Arrow" v-show="active">&#9650;</span>
            </a>
        </div>
        <div class="tab__content p-2" v-show="active">
           
                <slot name="content"></slot>
             
        </div>
    </div>
</template>

<style scoped>
blue-bg {
    background-color: #0e4977;
}
</style>
