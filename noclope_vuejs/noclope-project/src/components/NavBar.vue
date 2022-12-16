<template>
    <nav>
      <!--desktop menu-->
      <div class="bg-gray-900">
        <div class="max-w-7xl mx-auto">
          <div class="flex justify-between">
            <!-- menu -->
            <div class="flex space-x-4">
              <!-- logo -->
              <a href="/" class="flex items-center space-x-2 py-5 px-2">
                <img src="@/assets/logoNoclope.png" class="logoNoclope" alt="" />
              </a>
              <!-- menu -->
              <ul class="hidden md:flex items-center space-x-1">
                <li class="py-5 px-2">
                  <RouterLink
                    to="/"
                    class="text-xl text-slate-100 hover:text-blue-300"
                    >Accueil</RouterLink
                  >
                </li>
                <li v-if="!isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/project"
                    class="text-xl text-slate-100 hover:text-blue-300"
                    >Créer mon objectif</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/dashboard"
                    class="text-xl text-slate-100 hover:text-blue-300"
                    >Dashboard</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/transactions"
                    class="text-xl text-slate-100 hover:text-blue-300"
                    >Mes économies</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/contact"
                    class="text-slate-100 text-xl hover:text-blue-300"
                    >Mes Contacts</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/cracking"
                    class="text-slate-100 text-xl hover:text-blue-300"
                    >J'ai craqué</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/edit"
                    class="text-slate-100 text-xl hover:text-blue-300"
                    >Mon Profil</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="py-5 px-2">
                  <RouterLink
                    to="/"
                    class="text-slate-100 text-xl hover:text-blue-300"
                    @click="logoutUser"
                    >Se déconnecter</RouterLink
                  >
                </li>
              </ul>
            </div>
            <!-- login -->
            <ul class="hidden md:flex items-center space-x-1">
              <li v-if="!isLoggedIn()" class="py-5 px-2">
                <RouterLink
                  to="/login"
                  class="text-slate-100 text-xl hover:text-blue-300"
                  >Se connecter</RouterLink
                >
              </li>
              <li v-if="!isLoggedIn()" class="py-5 px-2">
                <RouterLink
                  to="/register"
                  class="text-slate-100 text-xl hover:text-blue-300"
                  >S'inscrire</RouterLink
                >
              </li>
            </ul>
            <!-- button show mobile munu -->
            <div class="md:hidden flex items-center">
              <button @click="showMobileMenu =! showMobileMenu " class="py-5 px-2">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="h-8 w-8 hover:text-blue-300 text-slate-100 w-6 h-6"
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
          <ul class="md:hidden bg-gray-900" :class="{hidden: showMobileMenu}">
                <li class="block py-2 px-4 text-slate-100 text-xl hover:bg-blue-300">
                  <RouterLink
                    to="/"
                    >Accueil</RouterLink
                  >
                </li>
                <li v-if="!isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-blue-300">
                  <RouterLink
                    to="/project"
                    >Créer mon objectif</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-blue-300">
                  <RouterLink
                    to="/dashboard"
                    >Dashboard</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-blue-300">
                  <RouterLink
                    to="/transactions"
                    >Mes économies</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-blue-300">
                  <RouterLink
                    to="/contact"
                    >Mes Contacts</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-blue-300">
                  <RouterLink
                    to="/cracking"
                    >J'ai craqué</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-blue-300">
                  <RouterLink
                    to="/edit"
                    >Mon Profil</RouterLink
                  >
                </li>
                <li v-if="isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-blue-300">
                  <RouterLink
                    to="/"
                    @click="logoutUser"
                    >Se déconnecter</RouterLink
                  >
                </li>
                <li v-if="!isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-blue-300">
                <RouterLink
                  to="/login"
                  >Se connecter</RouterLink
                >
              </li>
              <li v-if="!isLoggedIn()" class="block py-2 px-4 text-slate-100 text-xl hover:bg-blue-300">
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
    inject: ["isLoggedIn", "getUser", "logoutUser"],
  };
  </script>
  
  <style>
  .logoNoclope {
    height: 40px;
    width: 145px;
  }
  </style>