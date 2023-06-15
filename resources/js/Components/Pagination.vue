<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    pagination: Object,
});
</script>
<template>
    <nav class="relative flex justify-center mt-4">
        <template v-for="(link, index) in pagination.links" :key="link.label">
            <div class="relative">
                <Link
                    preserve-scroll
                    :href="link.url ?? ''"
                    class="flex items-center justify-center m-0.5 px-3 py-2 text-sm rounded-xl text-white"
                    :class="{
                        'bg-blue-300 hover:bg-blue-600': link.url && !link.active,
                        'bg-blue-500 hover:bg-blue-600': link.active,
                        'bg-gray-200 pointer-events-none': !link.url,
                    }"
                >
                    <span v-if="index === 0">&laquo;</span>
                    <span v-else-if="index === pagination.links.length - 1">&raquo;</span>
                    <span v-else>{{ link.label }}</span>
                </Link>
            </div>
        </template>
    </nav>
</template>

