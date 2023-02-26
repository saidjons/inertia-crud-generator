<template>



  <svg
                xmlns='http://www.w3.org/2000/svg'
                
                :fill='color'
                viewBox='0 0 24 24'
                stroke='black'
                :width="width" :height="height"
            >
            <g :fill="color">
                <path
                    fill='white'
                    stroke-linecap='round'
                    stroke-linejoin='round'
                    d='M4 6h16M4 12h16M4 18h16'
                />
              </g>
            </svg>

</template>

<script>
export default {
  props: {
    width: { type: String,default: '10px' },
    height: { type: String ,default: '10px' },
    color: { type: String ,default: '#000000' }
  }
}
</script>
