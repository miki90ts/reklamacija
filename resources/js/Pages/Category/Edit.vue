<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import BackLink from "@/Components/BackLink.vue";
import { Head, useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    category: Object,
});

const form = useForm({
    title: props.category.data.title,
    icon_name: props.category.data.icon,
});

function submit(category) {
    router.post(route("kategorije.update", category), {
        _method: "patch",
        title: form.title,
        icon_name: form.icon_name,
        icon: form.icon,
    });
}
</script>

<template>
    <Head title="Izmena kategorije" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Izmena kategorije
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto">
                            <div class="overflow-x-auto">
                                <form
                                    @submit.prevent="submit(category.data)"
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
                                        <InputLabel for="icon" value="Ikona" />

                                        <input
                                            type="file"
                                            @input="
                                                form.icon =
                                                    $event.target.files[0]
                                            "
                                            accept="image/*"
                                            id="icon"
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.icon"
                                        />
                                    </div>

                                    <div>
                                        <InputLabel
                                            for="icon_name"
                                            value="Ime ikone"
                                        />

                                        <TextInput
                                            id="icon_name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.icon_name"
                                            required
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.icon_name"
                                        />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <BackLink :href="route('kategorije')">
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
