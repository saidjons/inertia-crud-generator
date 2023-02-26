<script>
import { Link, router } from "@inertiajs/vue3";

import ArrowDownIcon from "@/Components/Icons/arrowDown.vue";
import ArrowUpIcon from "@/Components/Icons/arrowUp.vue";
export default {
  props: ["item"],

  components: {
    ArrowDownIcon,
    ArrowUpIcon,
    Link,
  },
  methods: {
    showSubs() {
      if (this.item.nested) {
        this.openSubs = !this.openSubs;
      } else {
        router.visit(this.item.link, { method: "get" });
      }
    },
  },
  data() {
    return {
      openSubs: false,
    };
  },
};
</script>
<template>
  <li class="flex flex-col w-full items-center my-2 text-lg text-bold">
    <div
      @click="showSubs"
      class="flex items-center focus:outline-none focus:ring-1 hover:bg-green-400 cursor-pointer leading-6 w-full"
    >
      <!-- icon here -->
      <ArrowDownIcon v-if="openSubs" width="20px" height="15px" />
      <ArrowUpIcon v-if="!openSubs" width="20px" height="15px" />

      <span class="text-sm ml-2">{{ item.title }}</span>
    </div>
    <div
      v-if="item.badgeNumber"
      class="py-1 px-3 rounded flex items-center justify-center text-xs"
    >
      {{ item.badgeNumber }}
    </div>
    <div
      v-show="openSubs"
      class="w-full bg-white px-0 ml-2 mb-2 capitalize font-semibold"
    >
      <template v-for="(sub, subIndex) in item.subs" :key="subIndex">
        <li
          class="flex w-full justify-between cursor-pointer items-center mb-2 hover:bg-green-200"
        >
          <!-- <a  :href="sub.link" class="  my-1 cursor-pointer items-center w-full  ">
                {{sub.title}}
              </a> -->
          <Link
            :href="sub.link"
            class="my-1 cursor-pointer items-center w-full"
            method="get"
            as="button"
            type="button"
            >{{ sub.title }}</Link
          >
          <div
            v-if="item.badgeNumber"
            class="py-1 px-3 rounded flex items-center justify-center text-xs"
          >
            {{ sub.badgeNumber }}
          </div>
        </li>
      </template>
    </div>
  </li>
</template>
