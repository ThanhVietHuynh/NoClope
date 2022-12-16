 <script setup>
import { RouterLink, RouterView } from "vue-router";
import NavBar from "./components/NavBar.vue";
import Footer from "./components/Footer.vue";

</script>

<template>
 <header>
    <NavBar/>
 </header>

  <body class="bg-blue-300">
     <RouterView />
     <Footer/>
 
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

<style>

</style>



