<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Footer from "@/Components/Footer.vue";
defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <Head title="Dobrodošli" />

  <div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
  >
    <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
      <Link
        v-if="$page.props.auth.user"
        :href="route('dashboard')"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
        >Kontrolna tabla</Link
      >

      <template v-else>
        <Link
          :href="route('login')"
          class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
          >Prijava</Link
        >

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
          >Registracija</Link
        >
      </template>
    </div>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-lg bg-white shadow-md rounded-lg overflow-hidden">
      <div class="bg-gradient-to-r from-blue-500 to-indigo-500 py-8 px-6">
        <div class="flex items-center justify-center">
          <ApplicationLogo class="w-16 h-16 text-white mr-2" />
          <h2 class="text-2xl font-bold text-white">Reklamacija.rs</h2>
        </div>
        <p class="text-white mt-2">Dobrodošli na naš portal koji vam omogućava kontrolu garancija za vaše električne uređaje. Pregledajte svoje račune, pratite istek garancije i još mnogo toga.</p>
      </div>
      <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Ključne funkcionalnosti</h3>
        <ul class="list-disc list-inside text-gray-600">
          <li>Pregledajte i upravljajte računima</li>
          <li>Pratite istek garancije</li>
          <li>Primajte obaveštenja o novim servisima i akcijama</li>
        </ul>
      </div>
      <div class="bg-gradient-to-r from-orange-500 to-amber-500 py-4 px-6">
        <a href="#" class="text-white font-bold hover:underline">Saznajte više</a>
      </div>
    </div>
  </div>
  </div>
  <Footer />
</template>