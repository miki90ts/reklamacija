<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import BackLink from "@/Components/BackLink.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    title: "",
    city: "",
    address: "",
    phone: "",
    email: "",
});
</script>

<template>
    <Head title="Unos prodavnice" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Unos prodavnice
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
                                        form.post(route('prodavnice.store'))
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
