<template>
 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" :stroke="color" 
 :width="width" :height="height"
 class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
</svg>




</template>

<script>
export default {
  props: {
    width: { type: String,default: '15px' },
    height: { type: String ,default: '15px' },
    color: { type: String ,default: '#000000' }
  }
}
</script>
