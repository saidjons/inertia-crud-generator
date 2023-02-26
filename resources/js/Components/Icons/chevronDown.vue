<template>
  

  <svg
                xmlns='http://www.w3.org/2000/svg'
                :width="width" :height="height"
                viewBox='0 0 24 24'
            >
            <g :fill="color">
                <path
                    fill='white'
                    stroke-linecap='round'
                    stroke-linejoin='round'
                    d='M19 9l-7 7-7-7'
                />
            </g>
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
