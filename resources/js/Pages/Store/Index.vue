<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";
import { useForm } from "@inertiajs/vue3";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    stores: {
        type: Object,
    },
});

const form = useForm({});

const deleteStore = (store) => {
    store.processing = true;
    form.delete(route("prodavnice.destroy", store));
};
</script>

<template>
    <Head title="Prodavnice" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Prodavnice
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto">
                            <Link
                                :href="route('prodavnice.create')"
                                class="w-14 text-sm my-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
                                {{ __("helpers.add") }}
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
                                                Lokacija
                                            </th>
                                            <th class="py-2 px-4 border-b">
                                                Telefon
                                            </th>
                                            <th class="py-2 px-4 border-b">
                                                Email
                                            </th>
                                            <th class="py-2 px-4 border-b"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="stores.data.length">
                                            <tr
                                                v-for="(
                                                    store, index
                                                ) in stores.data"
                                                :key="store.id"
                                            >
                                                <td
                                                    class="py-2 px-4 border-b text-center"
                                                >
                                                    {{
                                                        (stores.meta
                                                            .current_page -
                                                            1) *
                                                            stores.meta
                                                                .per_page +
                                                        index +
                                                        1
                                                    }}.
                                                </td>
                                                <td
                                                    class="py-2 px-4 border-b text-center"
                                                >
                                                    {{ store.title }}
                                                </td>
                                                <td
                                                    class="py-2 px-4 border-b text-center"
                                                >
                                                    {{ store.city }},
                                                    {{ store.address }}
                                                </td>
                                                <td
                                                    class="py-2 px-4 border-b text-center"
                                                >
                                                    {{ store.phone }}
                                                </td>
                                                <td
                                                    class="py-2 px-4 border-b text-center"
                                                >
                                                    {{ store.email }}
                                                </td>
                                                <td
                                                    class="py-2 px-4 border-b text-center"
                                                >
                                                    <div
                                                        class="flex items-baseline"
                                                    >
                                                        <Link
                                                            :href="`${route(
                                                                'prodavnice.edit',
                                                                store
                                                            )}`"
                                                            class="inline-block text-sm mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                        >
                                                            {{
                                                                __(
                                                                    "helpers.edit"
                                                                )
                                                            }}
                                                        </Link>

                                                        <DangerButton
                                                            class="ml-3"
                                                            @click="
                                                                deleteStore(
                                                                    store
                                                                )
                                                            "
                                                            :class="{
                                                                'opacity-25':
                                                                    store.processing,
                                                            }"
                                                            :disabled="
                                                                store.processing
                                                            "
                                                        >
                                                            {{
                                                                __(
                                                                    "helpers.delete"
                                                                )
                                                            }}
                                                        </DangerButton>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                        <template v-else>
                                            <tr>
                                                <td
                                                    class="text-center p-3"
                                                    colspan="5"
                                                >
                                                    Nema podataka
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>

                                <Pagination :pagination="stores.meta" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
