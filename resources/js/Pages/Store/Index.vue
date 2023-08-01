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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Prodavnice

                <svg
                    height="40px"
                    width="40px"
                    version="1.1"
                    id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 496 496"
                    xml:space="preserve"
                >
                    <path
                        style="fill: #b3dce0"
                        d="M496,309.6c0,27.2-6.4,48.8-32.8,48.8H32.8C5.6,358.4,0,336.8,0,309.6V186.4
	c0-27.2,21.6-48.8,48.8-48.8h398.4c27.2,0,48.8,21.6,48.8,48.8L496,309.6L496,309.6z"
                    />
                    <g>
                        <path
                            style="fill: #c1e3e5"
                            d="M0,186.4c0-27.2,21.6-48.8,48.8-48.8h398.4c27.2,0,48.8,21.6,48.8,48.8"
                        />
                    </g>
                    <path
                        style="fill: #9ecacc"
                        d="M464.8,308.8c0,5.6-4,9.6-9.6,9.6H40.8c-5.6,0-9.6-4-9.6-9.6l0,0c0-5.6,4-9.6,9.6-9.6h414.4
	C460.8,299.2,464.8,303.2,464.8,308.8L464.8,308.8z"
                    />
                    <path
                        style="fill: #7eaaaa"
                        d="M31.2,308.8L31.2,308.8c0-5.6,4-9.6,9.6-9.6h414.4c5.6,0,9.6,4,9.6,9.6l0,0"
                    />
                    <path
                        style="fill: #9ecacc"
                        d="M464.8,336c0,5.6-4,9.6-9.6,9.6H40.8c-5.6,0-9.6-4-9.6-9.6l0,0c0-5.6,4-9.6,9.6-9.6h414.4
	C460.8,326.4,464.8,330.4,464.8,336L464.8,336z"
                    />
                    <path
                        style="fill: #7eaaaa"
                        d="M31.2,336L31.2,336c0-5.6,4-9.6,9.6-9.6h414.4c5.6,0,9.6,4,9.6,9.6l0,0"
                    />
                    <path
                        style="fill: #46bc5c"
                        d="M145.6,267.2c0,2.4-2.4,4.8-4.8,4.8H39.2c-2.4,0-4.8-2.4-4.8-4.8v-33.6c0-2.4,2.4-4.8,4.8-4.8h102.4
	c2.4,0,4.8,2.4,4.8,4.8v33.6H145.6z"
                    />
                    <path
                        style="fill: #2fa53f"
                        d="M140.8,229.6c2.4,0,4.8,2.4,4.8,4.8V268c0,2.4-2.4,4.8-4.8,4.8H39.2c-2.4,0-4.8-2.4-4.8-4.8"
                    />
                </svg>
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
