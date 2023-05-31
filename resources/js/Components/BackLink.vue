<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <Link
        class="inline-flex items-center px-4 py-2 bg-white-800 border border-2 rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-grey-200 focus:bg-white-700 active:bg-white-900 focus:outline-none focus:ring-2 transition ease-in-out duration-150"
    >
        <slot />
    </Link>
</template>
