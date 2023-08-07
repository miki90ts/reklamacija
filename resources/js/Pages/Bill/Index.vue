<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";
import { reactive, ref } from "vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import Slider from "@vueform/slider";

const props = defineProps({
    bills: Object,
    query: Object,
    searchBills: Object,
    stores: Object,
    products: Object,
    brands: Object,
    categories: Object,
    prices: Object,
});

function openImageInNewTab(imageUrl) {
    window.open(imageUrl, "_blank");
}

const form = useForm({});

const deleteBill = (bill) => {
    bill.processing = true;
    form.delete(route("racuni.destroy", bill));
};

const categories = ref(props.categories);
const brands = ref(props.brands);
const products = ref(props.products);
const stores = ref(props.stores);

const maxPrice = ref(Number(props.prices.max_price));
const minPrice = ref(Number(props.prices.min_price));
// const maxPrice = ref(1000000);
// const minPrice = ref(0);

const isCategoryListOpen = ref(props.query.categories ?? false);
const isBrandsListOpen = ref(props.query.brands ?? false);
const isProductsListOpen = ref(props.query.products ?? false);
const isStoresListOpen = ref(props.query.stores ?? false);

const toggleCategoryList = () => {
    isCategoryListOpen.value = !isCategoryListOpen.value;
};

const toggleBrandsList = () => {
    isBrandsListOpen.value = !isBrandsListOpen.value;
};

const toggleProductsList = () => {
    isProductsListOpen.value = !isProductsListOpen.value;
};

const toggleStoresList = () => {
    isStoresListOpen.value = !isStoresListOpen.value;
};

const isPriceListOpen = ref(false);

const togglePriceList = () => {
    isPriceListOpen.value = !isPriceListOpen.value;
};

const Slidervalue = ref(
    props.query.price
        ? props.query.price.split(",").filter(Boolean).map(Number)
        : [0, maxPrice.value]
);

const sliderMinValue = ref(
    (props.query.price ?? "").split(",").filter(Boolean).map(Number)[0] ||
        minPrice.value
);
const sliderMaxValue = ref(
    (props.query.price ?? "").split(",").filter(Boolean).map(Number)[1] ||
        maxPrice.value
);

const showSliderValues = (value) => {
    sliderMinValue.value = value[0];
    sliderMaxValue.value = value[1];
};

const selectedCategories = ref(
    (props.query.categories ?? "").split(",").filter(Boolean).map(Number) || []
);

const selectedBrands = ref(
    (props.query.brands ?? "").split(",").filter(Boolean).map(Number) || []
);

const selectedProducts = ref(
    (props.query.products ?? "").split(",").filter(Boolean).map(Number) || []
);

const selectedStores = ref(
    (props.query.stores ?? "").split(",").filter(Boolean).map(Number) || []
);

const filterData = (type, value) => {
    const query = { ...props.query };

    if (type === "categories") {
        query.categories = value.join(",");
    } else if (type === "brands") {
        query.brands = value.join(",");
    } else if (type === "products") {
        query.products = value.join(",");
    } else if (type === "stores") {
        query.stores = value.join(",");
    } else if (type === "price") {
        query.price = value.join(",");
    }

    router.visit("/racuni", {
        data: query,
        preserveScroll: true,
    });
};

const filterCategories = (e) => {
    filterData("categories", selectedCategories.value);
};

const filterBrands = (e) => {
    filterData("brands", selectedBrands.value);
};

const filterProducts = (e) => {
    filterData("products", selectedProducts.value);
};

const filterStores = (e) => {
    filterData("stores", selectedStores.value);
};

const filterPrice = (value) => {
    filterData("price", value);
};
</script>

<template>
    <Head title="Računi" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("layouts.bills") }}
            </h2>
        </template>

        <div class="grid grid-cols-4">
            <div class="col-span-1">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                        >
                            <div class="mb-4">
                                <div
                                    class="flex items-center justify-between cursor-pointer p-3"
                                    @click="toggleCategoryList"
                                >
                                    <span class="text-lg font-bold"
                                        >Kategorija</span
                                    >
                                    <i
                                        :class="{
                                            'fa-solid fa-chevron-up':
                                                isCategoryListOpen,
                                            'fa-solid fa-chevron-down':
                                                !isCategoryListOpen,
                                        }"
                                        class="fas fa-lg"
                                    ></i>
                                </div>

                                <div
                                    v-if="
                                        isCategoryListOpen || query.categories
                                    "
                                >
                                    <div v-if="isCategoryListOpen">
                                        <div
                                            v-for="category in categories"
                                            :key="category.id"
                                        >
                                            <div
                                                class="border-b border-gray-300 p-2"
                                            >
                                                <label
                                                    class="flex items-center cursor-pointer"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        :id="`category_${category.id}`"
                                                        :value="category.id"
                                                        v-model="
                                                            selectedCategories
                                                        "
                                                        class="mr-2"
                                                        v-on:change="
                                                            filterCategories
                                                        "
                                                    />
                                                    {{ category.title }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div
                                    class="flex items-center justify-between cursor-pointer p-3"
                                    @click="toggleBrandsList"
                                >
                                    <span class="text-lg font-bold">Brend</span>
                                    <i
                                        :class="{
                                            'fa-solid fa-chevron-up':
                                                isBrandsListOpen,
                                            'fa-solid fa-chevron-down':
                                                !isBrandsListOpen,
                                        }"
                                        class="fas fa-lg"
                                    ></i>
                                </div>

                                <div v-if="isBrandsListOpen || query.brands">
                                    <div v-if="isBrandsListOpen">
                                        <div
                                            v-for="brand in brands"
                                            :key="brand.id"
                                        >
                                            <div
                                                class="border-b border-gray-300 p-2"
                                            >
                                                <label
                                                    class="flex items-center cursor-pointer"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        :id="`brand_${brand.id}`"
                                                        :value="brand.id"
                                                        v-model="selectedBrands"
                                                        class="mr-2"
                                                        v-on:change="
                                                            filterBrands
                                                        "
                                                    />
                                                    {{ brand.title }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div
                                    class="flex items-center justify-between cursor-pointer p-3"
                                    @click="toggleProductsList"
                                >
                                    <span class="text-lg font-bold"
                                        >Proizvodi</span
                                    >
                                    <i
                                        :class="{
                                            'fa-solid fa-chevron-up':
                                                isProductsListOpen,
                                            'fa-solid fa-chevron-down':
                                                !isProductsListOpen,
                                        }"
                                        class="fas fa-lg"
                                    ></i>
                                </div>

                                <div
                                    v-if="isProductsListOpen || query.products"
                                >
                                    <div v-if="isProductsListOpen">
                                        <div
                                            v-for="product in products"
                                            :key="product.id"
                                        >
                                            <div
                                                class="border-b border-gray-300 p-2"
                                            >
                                                <label
                                                    class="flex items-center cursor-pointer"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        :id="`product_${product.id}`"
                                                        :value="product.id"
                                                        v-model="
                                                            selectedProducts
                                                        "
                                                        class="mr-2"
                                                        v-on:change="
                                                            filterProducts
                                                        "
                                                    />
                                                    {{ product.title }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div
                                    class="flex items-center justify-between cursor-pointer p-3"
                                    @click="toggleStoresList"
                                >
                                    <span class="text-lg font-bold"
                                        >Prodavnica</span
                                    >
                                    <i
                                        :class="{
                                            'fa-solid fa-chevron-up':
                                                isStoresListOpen,
                                            'fa-solid fa-chevron-down':
                                                !isStoresListOpen,
                                        }"
                                        class="fas fa-lg"
                                    ></i>
                                </div>

                                <div v-if="isStoresListOpen || query.stores">
                                    <div v-if="isStoresListOpen">
                                        <div
                                            v-for="store in stores"
                                            :key="store.id"
                                        >
                                            <div
                                                class="border-b border-gray-300 p-2"
                                            >
                                                <label
                                                    class="flex items-center cursor-pointer"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        :id="`store_${store.id}`"
                                                        :value="store.id"
                                                        v-model="selectedStores"
                                                        class="mr-2"
                                                        v-on:change="
                                                            filterStores
                                                        "
                                                    />
                                                    {{ store.title }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div
                                    class="flex items-center justify-between cursor-pointer p-3"
                                    @click="togglePriceList"
                                >
                                    <span class="text-lg font-bold">Cena</span>
                                    <i
                                        :class="{
                                            'fa-solid fa-chevron-up':
                                                isPriceListOpen,
                                            'fa-solid fa-chevron-down':
                                                !isPriceListOpen,
                                        }"
                                        class="fas fa-lg"
                                    ></i>
                                </div>

                                <div v-if="isPriceListOpen || query.price">
                                    <div
                                        class="flex justify-between px-2 text-gray-500"
                                    >
                                        <span>{{ minPrice }}</span>
                                        <span>{{ maxPrice }}</span>
                                    </div>
                                    <div class="px-3 flex justify-center mt-3">
                                        <Slider
                                            v-model="Slidervalue"
                                            style="width: 80%"
                                            :min="minPrice"
                                            :max="maxPrice"
                                            @update="showSliderValues"
                                            @change="filterPrice"
                                            :lazy="false"
                                            :tooltips="false"
                                        />
                                    </div>
                                    <div class="my-2 text-center">
                                        <span
                                            >{{ sliderMinValue }} RSD -
                                            {{ sliderMaxValue }} RSD</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-3">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                        >
                            <div class="p-6 text-gray-900">
                                <div class="container mx-auto">
                                    <Link
                                        :href="route('racuni.create')"
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
                                                    <th
                                                        class="py-2 px-4 border-b"
                                                    >
                                                        ID
                                                    </th>
                                                    <th
                                                        class="py-2 px-4 border-b"
                                                    >
                                                        Radnja
                                                    </th>
                                                    <th
                                                        class="py-2 px-4 border-b"
                                                    >
                                                        Proizvod
                                                    </th>
                                                    <th
                                                        class="py-2 px-4 border-b"
                                                    >
                                                        Brend
                                                    </th>
                                                    <th
                                                        class="py-2 px-4 border-b"
                                                    >
                                                        Kategorija
                                                    </th>
                                                    <th
                                                        class="py-2 px-4 border-b"
                                                    >
                                                        Ističe garancija
                                                    </th>
                                                    <th
                                                        class="py-2 px-4 border-b"
                                                    >
                                                        Cena
                                                    </th>
                                                    <th
                                                        class="py-2 px-4 border-b"
                                                    >
                                                        Slika
                                                    </th>
                                                    <th
                                                        class="py-2 px-4 border-b"
                                                    ></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template
                                                    v-if="bills.data.length"
                                                >
                                                    <tr
                                                        v-for="(
                                                            bill, index
                                                        ) in bills.data"
                                                        :key="bill.id"
                                                    >
                                                        <td
                                                            class="py-2 px-4 border-b text-center"
                                                        >
                                                            {{ index + 1 }}.
                                                        </td>
                                                        <td
                                                            class="py-2 px-4 border-b text-center"
                                                        >
                                                            {{
                                                                bill.store.title
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-2 px-4 border-b text-center"
                                                        >
                                                            {{
                                                                bill.product
                                                                    .title
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-2 px-4 border-b text-center"
                                                        >
                                                            {{
                                                                bill.product
                                                                    .brand.title
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-2 px-4 border-b text-center"
                                                        >
                                                            {{
                                                                bill.product
                                                                    .brand
                                                                    .category
                                                                    .title
                                                            }}
                                                        </td>
                                                        <td
                                                            class="py-2 px-4 border-b text-center"
                                                        >
                                                            <div
                                                                class="flex flex-col"
                                                            >
                                                                <div>
                                                                    {{
                                                                        bill.expired_at
                                                                    }}
                                                                </div>
                                                                <div
                                                                    class="w-full h-4 bg-gray-200 rounded-full"
                                                                >
                                                                    <div
                                                                        :class="`h-full bg-${bill.color}-500 rounded-full`"
                                                                        :style="`width: ${bill.percent}%;`"
                                                                    ></div>
                                                                </div>
                                                                <div>
                                                                    {{
                                                                        bill.expired_at_for_humans
                                                                    }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="py-2 px-4 border-b text-center"
                                                        >
                                                            {{ bill.price }}
                                                        </td>
                                                        <td
                                                            class="py-2 px-4 border-b text-center"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="w-6 h-6 cursor-pointer"
                                                                @click="
                                                                    openImageInNewTab(
                                                                        bill.photo
                                                                    )
                                                                "
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
                                                                />
                                                            </svg>
                                                        </td>
                                                        <td
                                                            class="py-2 px-4 border-b text-center"
                                                        >
                                                            <div
                                                                class="flex items-baseline"
                                                            >
                                                                <Link
                                                                    :href="`${route(
                                                                        'racuni.edit',
                                                                        bill
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
                                                                        deleteBill(
                                                                            bill
                                                                        )
                                                                    "
                                                                    :class="{
                                                                        'opacity-25':
                                                                            bill.processing,
                                                                    }"
                                                                    :disabled="
                                                                        bill.processing
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
                                                            colspan="9"
                                                        >
                                                            Nemate računa
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>

                                        <Pagination
                                            v-if="bills.data.length"
                                            :pagination="bills.meta"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style src="@vueform/slider/themes/default.css"></style>
