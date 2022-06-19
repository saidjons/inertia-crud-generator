<script>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";

import { ChevronDownIcon } from "@/Components/Icons/hero";
export default {
    props: ["item"],

    components: {
        ChevronDownIcon,
        Link,
    },
    methods: {
        showSubs() {
            if (this.item.nested) {
                this.openSubs = !this.openSubs;
            } else {
                Inertia.visit(this.item.link, { method: "get" });
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
    <li class="flex w-full justify-between cursor-pointer items-center mb-6">
        <a
            href="javascript:void(0)"
            @click="showSubs"
            class="flex items-center focus:outline-none focus:ring-2 focus:ring-white w-full"
        >
            <!-- icon here -->
            <ChevronDownIcon />

            <span class="text-sm ml-2">{{ item.title }}</span>
        </a>
        <div
            v-if="item.badgeNumber"
            class="py-1 px-3 rounded flex items-center justify-center text-xs"
        >
            {{ item.badgeNumber }}
        </div>
    </li>
    <div v-show="openSubs" class="bg-white pl-2 mb-2 capitalize font-semibold">
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
</template>
