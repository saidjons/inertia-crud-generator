<script>
export default {
    props:{
        bg:{
            type:String,
            default:"#fff"
        },
        text:{
            type:String,
        },
        color:{
            type:String,
            default:"text-gray-600"
        }

    }
};
</script>

<template>
   
    <button
    @click="$emit('click')"
      type="button"
      class="inline-flex items-center py-2 px-4 m-0 text-sm font-medium leading-5 text-center  normal-case  rounded-md border border-gray-300 border-solid cursor-pointer"
      style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px; list-style: outside"
      :class="bg"
      v-bind:class="color"
    >
      {{text}}
    </button>
</template>
