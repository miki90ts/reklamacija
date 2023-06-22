<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Footer from "@/Components/Footer.vue";
import { ref } from 'vue';
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
const showMenu = ref(false);

const toggleMenu = () => {
  showMenu.value = !showMenu.value;
};
</script>
<style>
@media (min-width: 1024px) {
  .lg\:hidden {
    display: none !important;
  }
}
</style>
<template>
  <Head title="Dobrodošli" />
  <div class="bg-gradient-to-r from-blue-300 to-blue-500 p-4 shadow-2xl">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <div class="flex">
        <ApplicationLogo class="w-8 h-8 text-white" />
        <h1 class="text-xl m-1 font-bold text-white inline-block">
          <span> reklamacije.rs</span></h1>
      </div>

      <div v-if="canLogin" class="flex items-center">
        <button
          class="block lg:hidden text-white focus:outline-none"
          @click="toggleMenu"
        >
          <svg
            v-if="!showMenu"
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            ></path>
          </svg>
          <svg
            v-else
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            ></path>
          </svg>
        </button>
        <div class="flex flex-col lg:flex-row">
          <Link
          v-if="$page.props.auth.user"
          :href="route('dashboard')"
          class="font-semibold text-white hover:text-gray-300 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
          :class="{ 'hidden': !showMenu }"
        >
          Kontrolna tabla
        </Link>

        <template v-else>
          <Link
            :href="route('login')"
            class="ml-4 font-semibold text-white hover:text-gray-300 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            :class="{ 'hidden': !showMenu }"
          >
            Prijava
          </Link>

          <Link
            v-if="canRegister"
            :href="route('register')"
            class="ml-4 font-semibold text-white hover:text-gray-300 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            :class="{ 'hidden': !showMenu }"
          >
            Registracija
          </Link>
        </template>
        </div>
       
      </div>
    </div>
  </div>
  <div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-white dark:bg-dots-lighter dark:bg-gray-900 selection:bg-blue-500 selection:text-white"
  >
  
    <div class="min-h-screen w-full">
      <div class="w-full bg-white rounded-lg overflow-hidden container md:px-12">
        <div class="md:m-5 m-2">
          <div class="flex md:m-12 items-center">
            <ApplicationLogo class="w-48 h-48 text-white m-2 hidden md:block" />
            <div class="flex-column">
              <h1 class="md:text-5xl font-bold border-b-2 border-b-orange-400">Napredna evidencija garancija</h1>
              <p class="mx-3 mt-2 border-b-2 border-dotted">Dobrodošli na naš portal koji vam omogućava kontrolu garancija za vaše električne uređaje, automobile, građevinske radove i ostalo.
              <br>Precizna evidencija garancija uz napredne funkcionalnosti nikad nije bila lakša.
              <br>Dodajte svoje račune još danas, a mi ćemo umesto vas da mislimo.</p>
            </div>
          </div>
        </div>
      </div>          
      <div class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white p-5">
        <h2 class="text-2xl text-center font-semibold  mb-4">Ključne funkcionalnosti:</h2>
        <div class="flex justify-center  items-center">
          <ul class="list-none list-inside text-black p-2">
            <li class="p-2"><i class="fa-solid fa-camera fa-beat-fade mr-2 text-xl"></i> Dodajte račun lako uz pomoć telefona</li>
            <li class="p-2"><i class="fa-solid fa-clock fa-shake mr-2 text-xl"></i> Saznajte na vreme istek garancije</li>
            <li class="p-2"><i class="fa-solid fa-envelope fa-flip mr-2 text-xl"></i> Primajte obaveštenja o novim servisima i akcijama</li>
          </ul>
        </div>          
      </div>
      <div class="w-full h-48 text-black p-4">
        <div class="flex justify-center  items-center mb-5">
          <i class="fa-solid fa-share-nodes text-xl p-2"></i>
          <p class="p-2 italic">Zapratite nas na društvenim mrežama:</p>
        </div>          
        <div class="flex justify-center items-center">
        <a
          href="https://twitter.com/reklamacije_rs"
          target="_blank"
          rel="noopener noreferrer"
          class="text-6xl mx-5"
        >
          <i class="fab fa-twitter"></i>
        </a>
        <a
          href="https://www.facebook.com/reklamacije.rs"
          target="_blank"
          rel="noopener noreferrer"
          class="text-6xl mx-5"
        >
          <i class="fab fa-facebook-f"></i>
        </a>
        <a
          href="https://www.instagram.com/reklamacije.rs"
          target="_blank"
          rel="noopener noreferrer"
          class="text-6xl mx-5"
        >
          <i class="fab fa-instagram"></i>
        </a>
        </div>
      </div>
      
    </div>
    
  </div>
  <Footer />
</template>