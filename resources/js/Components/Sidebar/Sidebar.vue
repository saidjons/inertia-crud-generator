<script>
import SidebarItem from "./SidebarItem.vue";
//import {MenuIcon} from "@/Components/Icons/hero";
export default {
    components: {
        SidebarItem,
    },
    mounted() {
        this.setData();
    },
    methods: {
        setData() {
            this.errors = null;
            window.axios
                .get("/admin/api/menu/get/admin", {
                    headers: {
                        Accept: "application/json",
                        "X-CSRF-TOKEN": window.csrf,
                        Authorization: "Bearer " + window.token,
                    },

                })
                .then((res) => {
                    res.data.data.forEach((el) => {
                        this.sidebarItems.push(JSON.parse(el.data));
                    });
                })
                .catch((error) => {});
        },
        sidebarHandler() {
            this.hidden = !this.hidden;
        },
    },
    data() {
        return {
            hidden: true,
            sidebarItems: [],
        };
    },
};
</script>
<template>
    <!-- Sidebar starts  start
    to hide  .hidden flex
    to show sm:flex  
 
 -->
    <!-- Remove class [ hidden ] and replace [ sm:flex ] with [ flex ] -->
    <div
        style="min-height: 716px; z-index: 99"
        class="w-64 absolute shadow md:h-full flex-col justify-between text-black bg-gray-100 left-0 overflow-scroll"
        :class="[hidden == true ? 'hidden flex' : 'sm:flex ']"
    >
        <div class="px-8">
            <div class="h-16 w-full flex items-center">
                <img src="" alt=" Inertia Crud generator" />
            </div>
            <ul class="mt-12">
                <template
                    v-for="(item, itemIndex) in sidebarItems"
                    :key="itemIndex"
                >
                    <sidebar-item :item="item" />
                </template>
            </ul>
            <!-- search box  -->
        </div>
        <!-- sidebar bottom -->
    </div>

    <!-- second part start -->
    <!-- sidebar toggle button -->
    <div
        class="w-64 absolute bg-white shadow md:h-full flex-col justify-between transition duration-150 ease-in-out"
        id="mobile-nav"
        style="transform: translateX(-260px); z-index: 100"
    >
        <button
            aria-label="toggle sidebar"
            id="openSideBar"
            class="h-10 w-10 absolute right-0 mt-16 -mr-10 flex items-center shadow rounded-tr rounded-br justify-center cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 rounded focus:ring-gray-800"
            @click="sidebarHandler"
        >
          //  <MenuIcon />
        </button>
    </div>
    <!-- end sidebar toggle button -->
    <!-- second part end -->
</template>
