<script>
import { Link } from "@inertiajs/inertia-vue3";
import { getUrlWithoutQuery } from "@/plugins/functions";
import { TrashIcon, PencilIcon, EyeIcon } from "@/Components/Icons/hero.jsx";
export default {
  props: ["id"],
  components: {
    TrashIcon,
    PencilIcon,
    EyeIcon,
    Link,
  },
  mounted() {},
  methods: {
    setUrl() {
      return getUrlWithoutQuery();
    },
    deleteItem() {
      this.$emit("deleteItem", this.id);
    },
    editItem() {
      return `${this.setUrl()}/${this.id}/edit`;
    },
    viewItem() {
      return `${this.setUrl()}/${this.id}`;
    },
    data() {
      return {
        url: null,
      };
    },
  },
};
</script>

<template>
  <!-- :class='getObjectKey(item.slug,item)' -->
  <td class="border-dashed border-t border-gray-200 actions">
    <span class="text-gray-700 px-6 py-3 flex items-center gap-2">
      <button @click="deleteItem" class="hover:bg-red-300 transparent hover:text-black">
        <trash-icon />
      </button>

      <Link
        :href="editItem()"
        class="my-1 cursor-pointer items-center"
        method="get"
        as="button"
        type="button"
      >
        <pencil-icon
      /></Link>

      <Link
        :href="viewItem()"
        class="my-1 cursor-pointer items-center hover:bg-green-300 transparent hover:text-yellow-500"
        method="get"
        as="button"
        type="button"
      >
        <eye-icon
      /></Link>
    </span>
  </td>
</template>
