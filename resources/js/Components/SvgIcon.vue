<script setup>
import { defineAsyncComponent } from "vue";

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
});

const icon = defineAsyncComponent(() =>
    import(`../../../public/storage/svg/${props.name}.svg`)
);
</script>

<template>
    <component :is="icon" class="icon" />
</template>

<style scoped>
.icon {
    width: 20px;
    height: 20px;
    display: inline;
}
</style>
