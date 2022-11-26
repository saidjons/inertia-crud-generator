<script>
export default {
    props: ['header', 'subHeader']
}
</script>

<template>
    <div
        class="relative flex-grow-0 xs:text-center flex-shrink-0 px-4 mt-12 mb-4 w-full max-w-full leading-6 text-left text-gray-700 box-border 
  sm:px-6 lg:px-8
  "
        style="flex-basis: 100%;"
    >
        <h4
            class="mt-0 mb-2 font-serif text-xl font-normal uppercase box-border"
            style="line-height: 1.2;"
        >
            <slot></slot>
        </h4>
        <h4
            v-if="header"
            class="mt-0 mb-2 font-serif text-xl font-normal uppercase box-border"
            style="line-height: 1.2;"
        >
            {{ header }}
        </h4>
        <p
            v-if="subHeader"
            class=" xs:text-center mt-0 mb-4 text-left box-border"
        >
            {{ subHeader }}
        </p>
    </div>
</template>
