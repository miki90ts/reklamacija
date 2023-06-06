<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import BackLink from "@/Components/BackLink.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    warrantyLength: {
        type: Object,
    },
});

const form = useForm({
    title: props.warrantyLength.data.title,
    months: props.warrantyLength.data.months.toString(),
});
</script>

<template>
    <Head title="Warranty lengths-Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Izmena dužine garancije
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
                                                'warranty_lengths.update',
                                                warrantyLength.data
                                            )
                                        )
                                    "
                                    class="mt-6 space-y-6"
                                >
                                    <div>
                                        <InputLabel for="title" value="Naziv" />

                                        <TextInput
                                            id="title"
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
                                            for="months"
                                            value="Trajanje (meseci)"
                                        />

                                        <TextInput
                                            id="months"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.months"
                                            required
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.months"
                                        />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <BackLink
                                            :href="route('warranty_lengths')"
                                        >
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
