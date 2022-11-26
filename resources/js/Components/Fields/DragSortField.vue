<template>
  <div class="flex m-10">
    <draggable class="dragArea list-group w-full" :list="list" @change="inputChanged">
      <div
        class="list-group-item bg-gray-300 m-1 p-3 rounded-md text-center"
        v-for="element in list"
        :key="element[visibleField]"
      >
        {{ element[visibleField] }}
      </div>
    </draggable>
  </div>
</template>
<script>
  import { defineComponent } from 'vue'
  import { VueDraggableNext } from 'vue-draggable-next'


  export default defineComponent({
  props:['name','label','initialValue','visibleField','action'],

    components: {
      draggable: VueDraggableNext,
    },
    mounted() {
      this.list = this.initialValue
    },
    data() {
      return {
        enabled: true,
        list: [
         
        ],
        dragging: false,
      }
    },
    methods: {
      
       inputChanged(){
      this.$emit('inputChanged',
      {
        value:this.list,
        name:this.name,
      }
      )
    }
  },
  watch:{
    initialValue(n,o) {
      this.list = this.initialValue
      
    }
  }
   
  })
</script>