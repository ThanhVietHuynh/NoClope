<template>
    <nav>
      <!--desktop menu-->
      <div class="bg-teal-500">
        <div class="max-w-7xl mx-auto">
          <div class="flex justify-between">
            <!-- menu -->
            <div class="flex space-x-4">
              <!-- logo -->
              <a href="/" class="flex items-center space-x-2 py-5 px-2">
                <img src="@/assets/Logosansfond.png" class="w-16 h-15" alt="">
                <img src="@/assets/logoNoclope.png" class="logoNoclope" alt="" />
              </a>
              <!-- menu -->
              <ul class="hidden md:flex items-center space-x-1">
                <li class="py-5 px-2">
                  <RouterLink
                    to="/"
                    class="text-xl text-slate-100 hover:text-teal-300"
                    >Accueil</RouterLink
                  >
                </li>
                <li v-if="!isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/project"
                    class="text-xl text-slate-100 hover:text-teal-300"
                    >Créer mon objectif</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/dashboard"
                    class="text-xl text-slate-100 hover:text-teal-300"
                    >Dashboard</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/transactions"
                    class="text-xl text-slate-100 hover:text-teal-300"
                    >Mes économies</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/contact"
                    class="text-slate-100 text-xl hover:text-teal-300"
                    >Mes Contacts</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/cracking"
                    class="text-slate-100 text-xl hover:text-teal-300"
                    >J'ai craqué</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn() && isAdmin()" class="py-5 px-2">
                  <RouterLink
                    to="/admin"
                    class="text-slate-100 text-xl hover:text-teal-300"
                    >ADMIN</RouterLink
                  >
                </li>
              </ul>
            </div>
            <!-- login -->
            <ul class="hidden md:flex items-center space-x-1">
              <li v-if="isLoggedIn()" class="py-5 px-2">
                <RouterLink
                  to="/edit"
                  class="text-slate-100 text-xl hover:text-teal-300"
                  ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  </RouterLink
                >
              </li>
              <li v-if="isLoggedIn()" class="py-5 px-2">
                <RouterLink
                  to="/"
                  class="text-slate-100 text-xl hover:text-teal-300"
                  @click="logoutUser"
                  ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                   </svg>
                   </RouterLink
                >
              </li>
              <li v-if="!isLoggedIn()" class="py-5 px-2">
                <RouterLink
                  to="/login"
                  class="text-slate-100 text-xl hover:text-teal-300"
                  >Se connecter</RouterLink
                >
              </li>
              <li v-if="!isLoggedIn()" class="py-5 px-2">
                <RouterLink
                  to="/register"
                  class="text-slate-100 text-xl hover:text-teal-300"
                  >S'inscrire</RouterLink
                >
              </li>
            </ul>
            <!-- button show mobile munu -->
            <div class="md:hidden flex items-center">
              <button @click="showMobileMenu =! showMobileMenu" class="py-5 px-2">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="h-8 w-8 hover:text-teal-300 text-slate-100 w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!--Mobile menu-->
          <ul class="md:hidden bg-teal-500" :class="{hidden: showMobileMenu}">
                <li class="block py-2 px-4 text-slate-100 text-xl hover:bg-teal-300">
                  <RouterLink
                    to="/"
                    >Accueil</RouterLink
                  >
                </li>
                <li v-if="!isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-teal-300">
                  <RouterLink
                    to="/project"
                    >Créer mon objectif</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-teal-300">
                  <RouterLink
                    to="/dashboard"
                    >Dashboard</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-teal-300">
                  <RouterLink
                    to="/transactions"
                    >Mes économies</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-teal-300">
                  <RouterLink
                    to="/contact"
                    >Mes Contacts</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-teal-300">
                  <RouterLink
                    to="/cracking"
                    >J'ai craqué</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-teal-300">
                  <RouterLink
                    to="/edit"
                    ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg></RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-teal-300">
                  <RouterLink
                    to="/"
                    @click="logoutUser"
                    ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                   </svg></RouterLink
                  >
                </li>
                <li v-if="!isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-teal-300">
                <RouterLink
                  to="/login"
                  >Se connecter</RouterLink
                >
              </li>
              <li v-if="!isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-teal-300">
                <RouterLink
                  to="/register"
                  >S'inscrire</RouterLink
                >
              </li>
              </ul>
      
    </nav>
  </template>
  
  <script setup>
  import {ref} from 'vue';
  const showMobileMenu = ref(true);
  </script>
  
  <script>
  export default {
    name: "Navbar",
    inject: ["isLoggedIn", "getUser", "logoutUser","isAdmin"],
  };
  </script>
  
  <style>
  .logoNoclope {
    height: 40px;
    width: 145px;
  }
  </style>