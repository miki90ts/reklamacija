<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";
import { useForm } from "@inertiajs/vue3";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    products: {
        type: Object,
    },
});

const form = useForm({});

const deleteProduct = (product) => {
    product.processing = true;
    form.delete(route("proizvodi.destroy", product));
};
</script>

<template>
    <Head title="Proizvodi" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Proizvodi
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto">
                            <Link
                                :href="route('proizvodi.create')"
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
                                                Kategorija
                                            </th>
                                            <th class="py-2 px-4 border-b"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                product, index
                                            ) in products.data"
                                            :key="product.id"
                                        >
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{
                                                    (products.meta
                                                        .current_page -
                                                        1) *
                                                        products.meta.per_page +
                                                    index +
                                                    1
                                                }}.
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{ product.title }}
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{ product.category.title }}
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                <Link
                                                    :href="`${route(
                                                        'proizvodi.edit',
                                                        product
                                                    )}`"
                                                    class="inline-block text-sm mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                >
                                                    Izmeni
                                                </Link>

                                                <DangerButton
                                                    class="ml-3"
                                                    @click="
                                                        deleteProduct(product)
                                                    "
                                                    :class="{
                                                        'opacity-25':
                                                            product.processing,
                                                    }"
                                                    :disabled="
                                                        product.processing
                                                    "
                                                >
                                                    Obriši
                                                </DangerButton>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <Pagination :pagination="products.meta" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
