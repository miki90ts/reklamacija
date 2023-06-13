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
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Statistika
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
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="w-6 h-6"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm0 0h14M12 17v2M12 5V3"
                                                ></path>
                                            </svg>
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
