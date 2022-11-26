<script>
export default {
    props: ["next", "previous", "current"],
};
</script>

<template>
    <div class="">
        <div class="flex justify-center">
            <nav aria-label="Page navigation example">
                <ul class="flex list-style-none">
                    <li class="page-item">
                        <a
                        @click="$emit('prev')"
                            class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300   text-gray-800 hover:text-gray-800 focus:shadow-none"
                            href="#"
                            >Previous</a
                        >
                    </li>
                    <!-- <li class="page-item">
                        <a
                            class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300   text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                            href="#"
                            >1</a
                        >
                    </li>
                    <li class="page-item">
                        <a
                            class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300   text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                            href="#"
                            >2</a
                        >
                    </li>
                    <li class="page-item">
                        <a
                            class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300   text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                            href="#"
                            >3</a
                        >
                    </li> -->
                    <li class="page-item">
                        <a
                        @click='$emit("next")'
                            class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300   text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                            href="#"
                            >Next</a
                        >
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
