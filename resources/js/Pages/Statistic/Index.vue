<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

import DonutChart from "@/Components/DonutChart.vue";

const props = defineProps({
    priceByCategory: Array,
});
</script>

<template>
    <Head title="Statistika" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("layouts.statistics") }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto">
                            <div>
                                <DonutChart
                                    :priceByCategory="priceByCategory"
                                />
                            </div>

                            <div
                                v-for="price in priceByCategory"
                                :key="price.id"
                                class="my-4"
                            >
                                <div
                                    class="flex justify-between p-5 bg-gray-100 shadow-lg rounded-lg"
                                >
                                    <!-- Left side - Icon and Title -->
                                    <div class="flex items-center">
                                        <div class="">
                                            <span v-html="price.icon"></span>
                                        </div>
                                        <div class="ml-4 text-lg font-semibold">
                                            {{ price.category }}
                                        </div>
                                    </div>
                                    <!-- Right side - Price and Percentage -->
                                    <div class="text-right">
                                        <div class="text-lg font-semibold">
                                            {{ price.total_price }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ price.percentage }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
