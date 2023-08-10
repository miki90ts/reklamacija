<script setup>
import { ref } from "vue";
import Footer from "@/Components/Footer.vue";
import NavBar from "@/Components/NavBar.vue";
const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <NavBar/>
            <!-- Page Heading -->
            <header
                class="bg-gradient-to-r from-gray-700 to-gray-800 shadow-xl"
                v-if="$slots.header"
            >
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
    <Footer />
</template>
