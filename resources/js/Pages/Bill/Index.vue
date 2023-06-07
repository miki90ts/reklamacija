<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";

const props = defineProps({
    bills: Object,
});

function openImageInNewTab(imageUrl) {
    window.open(imageUrl, "_blank");
}

const form = useForm({});

const deleteBill = (bill) => {
    bill.processing = true;
    form.delete(route("bills.destroy", bill));
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Računi
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto">
                            <Link
                                :href="route('bills.create')"
                                class="w-14 text-sm my-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Add
                            </Link>

                            <div class="overflow-x-auto mt-3">
                                <table
                                    class="min-w-full bg-white border border-gray-300"
                                >
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b">
                                                ID
                                            </th>
                                            <th class="py-2 px-4 border-b">
                                                Radnja
                                            </th>
                                            <th class="py-2 px-4 border-b">
                                                Proizvod
                                            </th>
                                            <th class="py-2 px-4 border-b">
                                                Kategorija
                                            </th>
                                            <th class="py-2 px-4 border-b">
                                                Ističe garancija
                                            </th>
                                            <th class="py-2 px-4 border-b">
                                                Slika
                                            </th>
                                            <th class="py-2 px-4 border-b"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-if="bills.data.length"
                                            v-for="(bill, index) in bills.data"
                                            :key="bill.id"
                                        >
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{ index + 1 }}.
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{ bill.store.title }}
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{ bill.product.title }}
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{
                                                    bill.product.category.title
                                                }}
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{ bill.purchased_at }}
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-6 h-6 cursor-pointer"
                                                    @click="
                                                        openImageInNewTab(
                                                            bill.photo
                                                        )
                                                    "
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
                                                    />
                                                </svg>
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                <div class="flex">
                                                    <Link
                                                        :href="`${route(
                                                            'bills.edit',
                                                            bill
                                                        )}`"
                                                        class="inline-block text-sm mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                    >
                                                        Edit
                                                    </Link>

                                                    <DangerButton
                                                        class="ml-3"
                                                        @click="
                                                            deleteBill(bill)
                                                        "
                                                        :class="{
                                                            'opacity-25':
                                                                bill.processing,
                                                        }"
                                                        :disabled="
                                                            bill.processing
                                                        "
                                                    >
                                                        Delete
                                                    </DangerButton>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr v-else>
                                            <td
                                                class="text-center p-3"
                                                colspan="6"
                                            >
                                                Nemate računa
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <Pagination
                                    v-if="bills.data.length"
                                    :pagination="bills.meta"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
