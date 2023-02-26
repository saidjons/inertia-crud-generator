<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    stroke-width="1.5"
    :stroke="color"
    :width="width"
    :height="height"
    class="w-6 h-6"
  >
    <path
      fill="white"
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
    />
  </svg>
</template>

<script>
export default {
  props: {
    width: { type: String, default: "15px" },
    height: { type: String, default: "15px" },
    color: { type: String, default: "#000000" },
  },
};
</script>
