<script>
export default {
    mounted(){
        this.fetchWindowWith()
    },
    methods: {
        mobileMenuClicked() {
            this.mobileMenuShow = !this.mobileMenuShow;
        },
        mainMenuClicked() {
            this.mainMenuShow = !this.mainMenuShow;
        },
        fetchWindowWith(){
                window.addEventListener("resize", function(event) {
     if(document.body.clientWidth>767){
         this.mainMenuShow=true
     }else{
         this.mainMenuShow=false
     }
})

        }
    },
    data() {
        return {
            mobileMenuShow: false,
            mainMenuShow: true,

            mainMenuItems: [
                {
                    link: "/",
                    title: "Home",
                    permission: "admin",
                },
                {
                    link: "/about",
                    title: "About",
                    permission: "auth",
                },
                {
                    link: "/pricing",
                    title: "Pricing",
                    permission: "auth",
                },
                {
                    link: "/serivese",
                    title: "Services",
                    permission: "auth",
                },
            ],
            dropdownMenuItems: [
                {
                    link: "/admin",
                    title: "Admin Panel",
                    permission: "admin",
                },
                {
                    link: "/logout",
                    title: "Logout",
                    permission: "auth",
                    httpVerb: "post",
                },
            ],
        };
    },
};
</script>

<template>
    <div>
        <nav
            class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800"
        >
            <div
                class="container flex flex-wrap justify-between items-center mx-auto"
            >
                <a href="https://flowbite.com/" class="flex items-center">
                    <img
                        src="https://flowbite.com/docs/images/logo.svg"
                        class="mr-3 h-6 sm:h-9"
                        alt="Flowbite Logo"
                    />
                    <span
                        class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"
                        >Flowbite</span
                    >
                </a>
 
                <div class="flex items-center md:order-2 relative">
                    <button
                    @click="mobileMenuClicked"
                        type="button"
                        class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                      
 
                    >
                        <span class="sr-only">Open user menu</span>
                        <img
                            class="w-8 h-8 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-3.jpg"
                            alt="user photo"
                        />
                    </button>
                    <!-- Dropdown menu -->
                    <!-- hidden -->
                    <div
                    v-if="mobileMenuShow"
                        class="  absolute top-2 right-2 z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600  "
                        id="dropdown"
                  
                        
                    >
                        <div class="py-3 px-4">
                            <span
                                class="block text-sm text-gray-900 dark:text-white"
                                >{{$page.props.user.name}}</span
                            >
                            <span
                                class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400"
                                >{{ $page.props.user.email}}</span
                            >
                        </div>
                        <ul class="py-1" aria-labelledby="dropdown">
                            <li
                                v-for="dropdown in dropdownMenuItems"
                                :key="dropdown.title"
                            >
                       
                                    
                                <Link
                                    v-if="!dropdown.httpVerb"
                                    :href="dropdown.link"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                    >{{dropdown.title}}</Link
                                >
                       
                                <Link
                                    v-if="dropdown.httpVerb"
                                    :href="dropdown.link"
                                    method="post"
                                   
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                    >{{dropdown.title}}</Link>
                             
                            </li>
                        </ul>
                    </div>
                    <button
                        
                        type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="mobile-menu-2"
                        aria-expanded="false"
                        @click="mainMenuClicked"
                    >
                        <span class="sr-only">Open main menu</span>
                        <svg
                            class="w-6 h-6"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        <svg
                            class="hidden w-6 h-6"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                </div>
                <!-- hidden -->
                <div
                    v-if="mainMenuShow"
                    class="justify-between items-center w-full md:flex md:w-auto md:order-1"
                    id="mobile-menu-2"
                >
                    <ul
                        class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium"
                    >
                        <li v-for="menu in mainMenuItems" :key="menu.title">
                            <Link
                                :href="menu.link"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                                >{{ menu.title }}</Link
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
