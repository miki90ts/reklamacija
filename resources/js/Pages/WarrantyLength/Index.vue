<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";
import { useForm } from "@inertiajs/vue3";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    warrantyLengths: {
        type: Object,
    },
});

const form = useForm({});

const deleteWarrantyLengths = (warrantyLength) => {
    warrantyLength.processing = true;
    form.delete(route("duzina_garancije.destroy", warrantyLength));
};
</script>

<template>
    <Head title="Dužina garancije" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dužina garancije
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto">
                            <Link
                                :href="route('duzina_garancije.create')"
                                class="w-14 text-sm my-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Dodaj
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
                                                Naziv
                                            </th>
                                            <th class="py-2 px-4 border-b">
                                                Trajanje (meseci)
                                            </th>
                                            <th class="py-2 px-4 border-b"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                warrantyLength, index
                                            ) in warrantyLengths.data"
                                            :key="warrantyLength.id"
                                        >
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{
                                                    (warrantyLengths.meta
                                                        .current_page -
                                                        1) *
                                                        warrantyLengths.meta
                                                            .per_page +
                                                    index +
                                                    1
                                                }}.
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{ warrantyLength.title }}
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{ warrantyLength.months }}
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                <Link
                                                    :href="`${route(
                                                        'duzina_garancije.edit',
                                                        warrantyLength
                                                    )}`"
                                                    class="inline-block text-sm mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                >
                                                    Izmeni
                                                </Link>

                                                <DangerButton
                                                    class="ml-3"
                                                    @click="
                                                        deleteWarrantyLengths(
                                                            warrantyLength
                                                        )
                                                    "
                                                    :class="{
                                                        'opacity-25':
                                                            warrantyLength.processing,
                                                    }"
                                                    :disabled="
                                                        warrantyLength.processing
                                                    "
                                                >
                                                    Obriši
                                                </DangerButton>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <Pagination
                                    :pagination="warrantyLengths.meta"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
