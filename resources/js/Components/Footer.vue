<template>
  <footer class="bg-gray-800">
    <div
      class="container mx-auto py-4 px-6 flex flex-col md:flex-row items-center justify-between"
    >
      <div class="flex flex-col">
        <div class="flex items-center p-6">
          <ApplicationLogo class="w-8 h-8 text-white mr-2" />
          <p class="text-white">&copy; {{ currentYear }} reklamacije.rs</p>
        </div>
        <div class="text-white px-6">
          <hr>
          <ul>
            <li>Zakon o zaštiti potrošača</li>
            <li>Pravila</li>
            <li>O nama</li>
          </ul>
        </div>
      </div>
      <div class="flex items-center md:mt-0">
        <a
          href="https://twitter.com/reklamacije_rs"
          target="_blank"
          rel="noopener noreferrer"
          class="text-white mx-2"
        >
          <i class="fab fa-twitter"></i>
        </a>
        <a
          href="https://www.facebook.com/reklamacije.rs"
          target="_blank"
          rel="noopener noreferrer"
          class="text-white mx-2"
        >
          <i class="fab fa-facebook-f"></i>
        </a>
        <a
          href="https://www.instagram.com/reklamacije.rs"
          target="_blank"
          rel="noopener noreferrer"
          class="text-white mx-2"
        >
          <i class="fab fa-instagram"></i>
        </a>
      </div>
    </div>
  </footer>
</template>
  
  <script>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

export default {
  name: "Footer",
  components: {
    ApplicationLogo,
  },
  data() {
    return {
      currentYear: new Date().getFullYear(),
    };
  },
};
</script>
  