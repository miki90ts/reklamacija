<script setup>
    import ApplicationLogo from "@/Components/ApplicationLogo.vue";
    import Dropdown from "@/Components/Dropdown.vue";
    import DropdownLink from "@/Components/DropdownLink.vue";
    import NavLink from "@/Components/NavLink.vue";
    import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
    import { Link, router } from "@inertiajs/vue3";
</script>

<template>
    <nav class="bg-gradient-to-r from-white-300 to-gray-500 p-4 shadow-2xl">              
    <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('racuni')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800"/>
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-gray-800">
                            <NavLink :href="route('racuni')" :active="route().current('racuni')">
                                {{ __("layouts.bills") }}
                            </NavLink>
                            <NavLink :href="route('statistika')" :active="route().current('statistika')">
                                {{ __("layouts.statistics") }}
                            </NavLink>
                            <template v-if="$page.props.auth.user.admin">
                                <NavLink :href="route('kategorije')" :active="route().current('kategorije')">
                                    {{ __("layouts.categories") }}
                                </NavLink>
                                <NavLink :href="route('brands')" :active="route().current('brands')">
                                    {{ __("layouts.brands") }}
                                </NavLink>
                                <NavLink :href="route('proizvodi')" :active="route().current('proizvodi')">
                                    {{ __("layouts.products") }}
                                </NavLink>
                                <NavLink :href="route('prodavnice')" :active="route().current('prodavnice')">
                                    {{ __("layouts.stores") }}
                                </NavLink>
                                <NavLink :href="route('duzina_garancije')" :active="route().current('duzina_garancije')">
                                    {{ __("layouts.warrantyLength") }}
                                </NavLink>
                            </template>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Language Dropdown -->
                        <div class="ml-3 relative">
                            <select name="language" id="language"
                                v-on:change="
                                    router.post(
                                        route('language.store', {
                                            language: $event.target.value,
                                        })
                                    )
                                "
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm py-1"
                            >
                                <option
                                    :value="language.value"
                                    v-for="language in $page.props.languages
                                        .data"
                                    :key="language.value"
                                    :selected="
                                        language.value ===
                                        $page.props.language
                                    "
                                >
                                    {{ language.label }}
                                </option>
                            </select>
                        </div>
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-800 hover:text-gray-600 focus:outline-none transition ease-in-out duration-150"
                                        >
                                            <i
                                                class="fa-solid fa-user px-2 mb-1"
                                            ></i>
                                            {{ $page.props.auth.user.name }}

                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink
                                        :href="route('profile.edit')"
                                    >
                                        {{ __("layouts.profile") }}
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        {{ __("layouts.logOut") }}
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="sm:hidden"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink
                        :href="route('racuni')"
                        :active="route().current('racuni')"
                    >
                        {{ __("layouts.bills") }}
                    </ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-900">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-700">
                            {{ $page.props.auth.user.email }}
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')">
                            {{ __("layouts.profile") }}
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('logout')"
                            method="post"
                            as="button"
                        >
                            {{ __("layouts.logOut") }}
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>
</template>