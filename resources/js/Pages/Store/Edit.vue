<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import BackLink from "@/Components/BackLink.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    store: Object,
});

const form = useForm({
    title: props.store.data.title,
    city: props.store.data.city,
    address: props.store.data.address,
    phone: props.store.data.phone,
    email: props.store.data.email,
});
</script>

<template>
    <Head title="Izmena prodavnice" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Izmena Prodavnice
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
                                                'prodavnice.update',
                                                store.data
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
                                        <InputLabel for="city" value="Grad" />

                                        <TextInput
                                            id="city"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.city"
                                            required
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.city"
                                        />
                                    </div>

                                    <div>
                                        <InputLabel
                                            for="address"
                                            value="Adresa"
                                        />

                                        <TextInput
                                            id="address"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.address"
                                            required
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.address"
                                        />
                                    </div>

                                    <div>
                                        <InputLabel
                                            for="phone"
                                            value="Telefon"
                                        />

                                        <TextInput
                                            id="phone"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.phone"
                                            required
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.phone"
                                        />
                                    </div>

                                    <div>
                                        <InputLabel for="email" value="Email" />

                                        <TextInput
                                            id="email"
                                            type="email"
                                            class="mt-1 block w-full"
                                            v-model="form.email"
                                            required
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.email"
                                        />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <BackLink :href="route('prodavnice')">
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
