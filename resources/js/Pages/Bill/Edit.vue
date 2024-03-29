<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import BackLink from "@/Components/BackLink.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { Head, useForm, router } from "@inertiajs/vue3";

import { ref, computed } from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

function submit(bill) {
    router.post(route("racuni.update", bill), {
        _method: "patch",
        category_id: form.category_id,
        brand_id: form.brand_id,
        product_id: form.product_id,
        store_id: form.store_id,
        photo: form.photo,
        purchased_at: form.purchased_at,
        warranty_length_id: form.warranty_length_id,
        price: form.price,
        note: form.note,
    });
}

const date = ref();

const format = (date) => {
    const day = date.getDate().toString().padStart(2, "0");
    const month = (date.getMonth() + 1).toString().padStart(2, "0");
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
};

const props = defineProps({
    bill: {
        type: Object,
    },
    categories: {
        type: Object,
    },
    brands: {
        type: Object,
    },
    stores: {
        type: Object,
    },
    products: {
        type: Object,
    },
    warrantyLengths: {
        type: Object,
    },
});

const form = useForm({
    category_id: props.bill.product.brand.category.id.toString(),
    brand_id: props.bill.product.brand.id.toString(),
    product_id: props.bill.product_id.toString(),
    store_id: props.bill.store_id.toString(),
    photo: "",
    purchased_at: props.bill.purchased_at,
    warranty_length_id: props.bill.warranty_length_id.toString(),
    price: props.bill.price,
    note: props.bill.note ?? "",
});

const filteredBrands = computed(() => {
    if (form.category_id) {
        return Object.values(props.brands.data).filter(
            (brand) => brand.category_id === Number(form.category_id)
        );
    }

    return Object.values(props.brands.data);
});

const filteredProducts = computed(() => {
    if (form.brand_id) {
        return Object.values(props.products.data).filter(
            (product) => product.brand_id === Number(form.brand_id)
        );
    }

    return Object.values(props.products.data);
});

function setFilteredBrands(data) {
    form.category_id = data;
}

function setFilteredProducts(data) {
    form.brand_id = data;
}
</script>

<template>
    <Head title="Product-Add" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Izmena računa
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto">
                            <div class="overflow-x-auto">
                                <form
                                    @submit.prevent="submit(bill)"
                                    class="mt-6 space-y-6"
                                >
                                    <div>
                                        <InputLabel
                                            for="category_id"
                                            value="Kategorija"
                                        />

                                        <SelectInput
                                            v-model="form.category_id"
                                            keyIndex="id"
                                            valueIndex="id"
                                            labelIndex="title"
                                            :data="categories.data"
                                            :showChoose="true"
                                            id="category_id"
                                            class="mt-1 block w-full"
                                            required
                                            @update:modelValue="
                                                setFilteredBrands
                                            "
                                        ></SelectInput>

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.category_id"
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
                                            :data="filteredBrands"
                                            :showChoose="true"
                                            id="brand_id"
                                            class="mt-1 block w-full"
                                            required
                                            @update:modelValue="
                                                setFilteredProducts
                                            "
                                        ></SelectInput>

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.brand_id"
                                        />
                                    </div>

                                    <div>
                                        <InputLabel
                                            for="product_id"
                                            value="Proizvod"
                                        />

                                        <SelectInput
                                            v-model="form.product_id"
                                            keyIndex="id"
                                            valueIndex="id"
                                            labelIndex="title"
                                            :data="filteredProducts"
                                            :showChoose="true"
                                            id="product_id"
                                            class="mt-1 block w-full"
                                            required
                                        ></SelectInput>

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.product_id"
                                        />
                                    </div>

                                    <div>
                                        <InputLabel
                                            for="store_id"
                                            value="Prodavnica"
                                        />

                                        <SelectInput
                                            v-model="form.store_id"
                                            keyIndex="id"
                                            valueIndex="id"
                                            labelIndex="title"
                                            :data="stores.data"
                                            :showChoose="true"
                                            id="store_id"
                                            class="mt-1 block w-full"
                                            required
                                        ></SelectInput>

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.store_id"
                                        />
                                    </div>

                                    <div>
                                        <InputLabel for="photo" value="Slika" />

                                        <input
                                            type="file"
                                            @input="
                                                form.photo =
                                                    $event.target.files[0]
                                            "
                                            accept="image/*"
                                            id="photo"
                                        />
                                        <progress
                                            v-if="form.progress"
                                            :value="form.progress.percentage"
                                            max="100"
                                        >
                                            {{ form.progress.percentage }}%
                                        </progress>
                                    </div>

                                    <div>
                                        <InputLabel value="Datum kupovine" />

                                        <VueDatePicker
                                            v-model="form.purchased_at"
                                            auto-apply
                                            :enable-time-picker="false"
                                            :format="format"
                                            :max-date="new Date()"
                                            required
                                        ></VueDatePicker>
                                    </div>

                                    <div>
                                        <InputLabel
                                            for="warranty_length_id"
                                            value="Dužina garancije"
                                        />

                                        <SelectInput
                                            v-model="form.warranty_length_id"
                                            keyIndex="id"
                                            valueIndex="id"
                                            labelIndex="title"
                                            :data="warrantyLengths.data"
                                            id="warranty_length_id"
                                            class="mt-1 block w-full"
                                            required
                                        ></SelectInput>

                                        <InputError
                                            class="mt-2"
                                            :message="
                                                form.errors.warranty_length_id
                                            "
                                        />
                                    </div>

                                    <div>
                                        <InputLabel for="price" value="Cena" />

                                        <TextInput
                                            id="price"
                                            type="number"
                                            class="mt-1 block w-full"
                                            v-model="form.price"
                                            step="0.01"
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.price"
                                        />
                                    </div>

                                    <div>
                                        <InputLabel
                                            for="note"
                                            value="Beleška"
                                        />

                                        <TextAreaInput
                                            id="note"
                                            class="mt-1 block w-full"
                                            v-model="form.note"
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.note"
                                        />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <BackLink :href="route('racuni')">
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
