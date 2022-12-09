 <script setup>
import { RouterLink, RouterView } from "vue-router";
import NavBar from "./components/NavBar.vue";

</script>

<!-- <template>
    <section id="pageform">
    <header>
      <img src="../src/assets/50472272840e49d3934e9094dbca76fd.png" alt="">
      <nav>
        <RouterLink to="/" class="router">Accueil</RouterLink>
        <RouterLink to="/project" class="router">Mon Projet</RouterLink>
        <RouterLink to="/contact" class="router">Contact</RouterLink>
        <RouterLink to="/register" class="router">S'enregistrer</RouterLink>
        <RouterLink to="/login" class="router">Se connecter</RouterLink>
        <RouterLink to="/cracking" class="router">J'ai craqué</RouterLink>
      </nav>
    </header>
    <RouterView v-slot="{ Component, route }">
      <Transition name="fade" mode="out-in">
        <div :key="route.name">
          <component :is="Component" />
        </div>
      </Transition>
    </RouterView>

    <footer>
      <div class="container">
          <p class="m-0 text-center text-white">December 2022 &copy; No Clope by Mathilde & Thanh & Marlee & Nabil</p>
      </div>
    </footer>
  </section>
</template> -->

<!-- <style>
nav{
  display: flex;
  justify-content: space-between;
}

</style>  -->

<template>
 <header>
    <NavBar/>
 </header>

  <body class="bg-blue-300">
     <RouterView />
  </body>
</template>


<script>
import Navbar from "./components/NavBar.vue";
export default{
  name:"App",
  components:{
    Navbar,
    RouterView,
  },
};
</script>



