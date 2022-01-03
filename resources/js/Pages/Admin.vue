<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
export default {
  components: {
    AdminLayout,
    
  },

  setup() {
    
  },
}
</script>

<template>
  <admin-layout >
      <template v-slot:content>
    <h1>Here might be a page title</h1>
  </template>

  </admin-layout>
</template>