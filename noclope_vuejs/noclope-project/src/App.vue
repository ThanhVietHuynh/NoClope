<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
    <section id="pageform">
    <header>
      <img src="../src/assets/50472272840e49d3934e9094dbca76fd.png" alt="">
      <nav>
        <RouterLink to="/" class="router">Accueil</RouterLink>
        <RouterLink to="/project" class="router">Mon Projet</RouterLink>
        <RouterLink to="/contact" class="router">Contact</RouterLink>
      </nav>
    </header>
    <RouterView v-slot="{ Component, route }">
      <Transition name="fade" mode="out-in">
        <div :key="route.name">
          <component :is="Component" />
        </div>
      </Transition>
    </RouterView>
  </section>
</template>

<style>

</style>
