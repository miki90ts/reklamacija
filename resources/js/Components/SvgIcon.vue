<script setup>
import { defineAsyncComponent } from "vue";

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
});

const icon = defineAsyncComponent(() =>
    import(`../../../public/assets/svg/${props.name}.svg`)
);
</script>

<template>
    <component :is="icon" />
</template>
