<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-gray-900 font-base font-bold leading-5 text-gray-900 focus:outline-none focus:border-gray-700 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-base font-bold leading-5 text-gray-800 hover:text-gray-700 hover:border-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-700 transition duration-300 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
