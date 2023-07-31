<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import BackLink from "@/Components/BackLink.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    product: Object,
    brands: Object,
});

const form = useForm({
    title: props.product.data.title,
    brand_id: props.product.data.brand.id.toString(),
});
</script>

<template>
    <Head title="Izmena proizvoda" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Izmena Proizvoda
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto">
                            <div class="overflow-x-auto">
                                <form
                                    @submit.prevent="
                                        form.patch(
                                            route(
                                                'proizvodi.update',
                                                product.data
                                            )
                                        )
                                    "
                                    class="mt-6 space-y-6"
                                >
                                    <div>
                                        <InputLabel for="title" value="Naziv" />

                                        <TextInput
                                            id="name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.title"
                                            required
                                            autofocus
                                            autocomplete="title"
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.title"
                                        />
                                    </div>

                                    <div>
                                        <InputLabel
                                            for="brand_id"
                                            value="Brend"
                                        />

                                        <SelectInput
                                            v-model="form.brand_id"
                                            keyIndex="id"
                                            valueIndex="id"
                                            labelIndex="title"
                                            :data="brands.data"
                                            :showChoose="false"
                                            id="brand_id"
                                            class="mt-1 block w-full"
                                            required
                                        ></SelectInput>

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.brand_id"
                                        />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <BackLink :href="route('proizvodi')">
                                            Nazad
                                        </BackLink>
                                        <div class="flex items-center gap-4">
                                            <PrimaryButton
                                                :disabled="form.processing"
                                                >Sačuvaj
                                            </PrimaryButton>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
