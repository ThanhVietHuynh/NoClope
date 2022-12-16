 <script setup>
import { RouterLink, RouterView } from "vue-router";
import loginUser from "./views/LoginView.vue";
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
export default {
  name: "App",
  components: {
    NavBar,
    loginUser,
    RouterView,
  },

  data() {
    return {
      isLoggedIn: false,
      user: null,
    };
  },

  methods: {
    checkToken() {
      const token = localStorage.getItem("token");
      if (token) {
        this.isLoggedIn = true;
      }
    },
    login(token, user) {
      localStorage.setItem("token", token);
      this.isLoggedIn = true;
      this.user = user;
    },
    logout() {
      localStorage.removeItem("token");
      this.isLoggedIn = false;
      this.user = null;
    },
  },

  mounted() {
    this.checkToken();
  },

  provide() {
    return {
      isLoggedIn: () => this.isLoggedIn,
      getUser: () => this.user,
      loginUser: this.login,
      logoutUser:  this.logout,
    };
  },
};
</script>

<style>

</style>



