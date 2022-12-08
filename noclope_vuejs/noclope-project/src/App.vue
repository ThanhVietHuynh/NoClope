<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
    <section id="pageform">
    <header>
      <img src="../src/assets/50472272840e49d3934e9094dbca76fd.png" alt="">
      <nav>
        <div>
          <RouterLink to="/" class="router">Accueil</RouterLink>
          <RouterLink to="/project" class="router">Mon Projet</RouterLink>
          <RouterLink to="/contact" class="router">Contact</RouterLink>
          <RouterLink to="/register" class="router">S'enregistrer</RouterLink>
          <RouterLink to="/login" class="router">Se connecter</RouterLink>
        </div>
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
</template>

<style>
nav{
  display: flex;
  justify-content: space-between;
}

</style>
