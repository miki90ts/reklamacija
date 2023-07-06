<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";
import { useForm } from "@inertiajs/vue3";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    kategorije: {
        type: Object,
    },
});

const form = useForm({});

const deleteCategory = (category) => {
    category.processing = true;
    form.delete(route("kategorije.destroy", category));
};
</script>

<template>
    <Head title="Kategorije" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kategorije
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto">
                            <Link
                                :href="route('kategorije.create')"
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
                                                Ikona
                                            </th>
                                            <th class="py-2 px-4 border-b">
                                                Naziv
                                            </th>
                                            <th class="py-2 px-4 border-b"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                category, index
                                            ) in kategorije.data"
                                            :key="category.id"
                                        >
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{
                                                    (kategorije.meta
                                                        .current_page -
                                                        1) *
                                                        kategorije.meta
                                                            .per_page +
                                                    index +
                                                    1
                                                }}.
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                <span
                                                    v-html="category.icon"
                                                ></span>
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                {{ category.title }}
                                            </td>
                                            <td
                                                class="py-2 px-4 border-b text-center"
                                            >
                                                <Link
                                                    :href="`${route(
                                                        'kategorije.edit',
                                                        category
                                                    )}`"
                                                    class="inline-block text-sm mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                >
                                                    Izmeni
                                                </Link>

                                                <DangerButton
                                                    class="ml-3"
                                                    @click="
                                                        deleteCategory(category)
                                                    "
                                                    :class="{
                                                        'opacity-25':
                                                            category.processing,
                                                    }"
                                                    :disabled="
                                                        category.processing
                                                    "
                                                >
                                                    Obriši
                                                </DangerButton>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <Pagination :pagination="kategorije.meta" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
