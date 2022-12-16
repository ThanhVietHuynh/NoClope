<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>


<script>
export default {
  name: "Navbar",
  inject: ["isLoggedIn", "getUser", "logoutUser"],
};
</script>

<template>
    <div class="bg-gray-900 text-gray-100 py-3 px-6 shadow md:flex justify-between items-center">
    <div class="flex items-center">
        <img src="@/assets/logoNoclope.png" class="logoNoclope" alt="">
    </div>
     <nav>
         <ul class="md-flex md:items-center md:px-0 px-3 md:pb-0 pb-10 md:static absolute bg-gray-900 md:w-auto w-full top-14 duration-700 ease-in flex flex">
            <li class="md:mx-4 md:my-0 my-6">
                <RouterLink to="/" class="text-xl hover:text-blue-300">Accueil</RouterLink>
            </li>
            <li v-if="!isLoggedIn()" class="md:mx-4 md:my-0 my-6">
                <RouterLink to="/project" class=" text-xl hover:text-blue-300">Créer mon objectif</RouterLink>
            </li>
            <li v-if="!isLoggedIn()" class="md:mx-4 md:my-0 my-6">
                <RouterLink to="/register" class=" text-xl hover:text-blue-300">S'inscrire</RouterLink>
            </li>
            <li v-if="!isLoggedIn()" class="md:mx-4 md:my-0 my-6">
                <RouterLink to="/login" class=" text-xl hover:text-blue-300">Se connecter</RouterLink>
            </li>
            <li v-if="isLoggedIn()" class="md:mx-4 md:my-0 my-6">
                <RouterLink to="/dashboard" class="text-xl hover:text-blue-300">Dashboard</RouterLink>
            </li>
            <li v-if="isLoggedIn()" class="md:mx-4 md:my-0 my-6">
                <RouterLink to="/transactions" class="text-xl hover:text-blue-300">Mes économies</RouterLink>
            </li>
            <li v-if="isLoggedIn()" class="md:mx-4 md:my-0 my-6">
                <RouterLink to="/contact" class=" text-xl hover:text-blue-300">Mes Contacts</RouterLink>
            </li>
            <li v-if="isLoggedIn()" class="md:mx-4 md:my-0 my-6">
                <RouterLink to="/cracking" class=" text-xl hover:text-blue-300">J'ai craqué</RouterLink>
            </li>
            <li v-if="isLoggedIn()" class="md:mx-4 md:my-0 my-6">
                <RouterLink to="/edit" class=" text-xl hover:text-blue-300">Mon Profil</RouterLink>
            </li>
            <li v-if="isLoggedIn()" class="md:mx-4 md:my-0 my-6">
                <RouterLink to="/" class=" text-xl hover:text-blue-300" @click="logoutUser">Se déconnecter</RouterLink>
            </li>
        </ul>
     </nav>
    </div>
</template>


<style scoped>

.logoNoclope{
    height: 40px;
    width: 145px;
}
</style>