<script setup>
import { ref } from "vue";

defineProps({
    modelValue: String,
    keyIndex: String,
    valueIndex: String,
    labelIndex: String,
    data: Array,
    showChoose: Boolean,
});

defineEmits(["update:modelValue"]);
</script>

<template>
    <select
        ref="input"
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
    >
        <option v-if="showChoose" value="">Izaberite</option>
        <option
            v-for="item in data"
            :key="item[keyIndex]"
            :value="item[valueIndex]"
        >
            {{ item[labelIndex] }}
        </option>
    </select>
</template>
