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
const showMenu = ref(true);

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
  
  <nav class="bg-gradient-to-r from-blue-400 to-blue-500 p-4 shadow-2xl">
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
  </nav>
  <div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-white dark:bg-dots-lighter dark:bg-gray-900 selection:bg-blue-500 selection:text-white"
  >
  
    <div class="min-h-screen w-full">
      <div class="w-full bg-repeat overflow-hidden md:px-12 min-h-screen" style="background-image:url(images/background_image_opacity_50.png)">
        <div class="md:m-5 m-2">
          <div class="flex md:m-12 items-center">
            <img src="images/Hero image.png" class="animate-wiggle  mt-10 max-w-xl p-10 hover:animate-none duration-300 transition-animate delay-300" >
            <div class="flex-column font-bold bg-gradient-to-b rounded-xl from-white via-white to-transparent px-5">
              <h1 class="md:text-8xl font-bold border-b-8 border-b-orange-500 border-dashed inline-block mb-11 py-2 ">
                <span class="text-orange-500 hover:cursor-default hover:text-blue-600 transition-all duration-300">EVIDE</span>
                <!--span class="text-orange-500 hover:text-blue-600 transition-all duration-300">V</span>
                <span class="text-orange-500 hover:text-blue-600 transition-all duration-300">I</span>
                <span class="text-orange-500 hover:text-blue-600 transition-all duration-300">D</span>
                <span class="text-orange-500 hover:text-blue-600 transition-all duration-300">E</span-->
                <span class="hover:text-orange-500 hover:cursor-default cursor-default text-blue-600 transition-all duration-300">&nbsp;NCIJA</span>
                <!--span class="hover:text-orange-500 text-blue-600 transition-all duration-300">C</span>
                <span class="hover:text-orange-500 text-blue-600 transition-all duration-300">I</span>
                <span class="hover:text-orange-500 text-blue-600 transition-all duration-300">J</span>
                <span class="hover:text-orange-500 text-blue-600 transition-all duration-300">A</span--><br>              
                <span class="hover:text-orange-500 hover:cursor-default text-blue-600 transition-all duration-300 tracking-wider">GARA</span>
                <!--span class="hover:text-orange-500 text-blue-600 transition-all duration-300">A</span>
                <span class="hover:text-orange-500 text-blue-600 transition-all duration-300">R</span>
                <span class="hover:text-orange-500 text-blue-600 transition-all duration-300">A</span-->
                <span class="text-orange-500 hover:cursor-default hover:text-blue-600 transition-all duration-300 pl-3">NCIJA</span>
                <!--span class="text-orange-500 hover:text-blue-600 transition-all duration-300">C</span>
                <span class="text-orange-500 hover:text-blue-600 transition-all duration-300">I</span>
                <span class="text-orange-500 hover:text-blue-600 transition-all duration-300">J</span>
                <span class="text-orange-500 hover:text-blue-600 transition-all duration-300">A</span-->
              </h1> <br>
              <Link :href="route('racuni.create')" class="text-4xl bg-blue-500 hover:bg-orange-500 hover:px-11 text-white font-bold py-2 px-4 rounded transition-all">Dodaj garanciju!</Link>         
            </div>
          </div>
        </div>
      </div>          
      <div class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white p-5 min-h-screen">
        <p class="mx-3 mt-2  text-xl text-center mb-8"><span class="text-black font-bold">Dobrodošli</span> na naš portal koji vam omogućava kontrolu garancija za Vaše <span class="text-black font-bold">električne uređaje</span>, <span class="text-black font-bold">automobile</span>, <span class="text-black font-bold">građevinske radove</span> i ostalo.
              <br>Precizna evidencija garancija uz napredne funkcionalnosti nikad nije bila lakša.
              <br>Dodajte svoje račune još danas, a mi ćemo umesto vas da mislimo.</p>
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