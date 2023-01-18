<script setup>
import { RouterLink, RouterView } from "vue-router";
import loginUser from "./views/LoginView.vue";
import NavBar from "./components/NavBar.vue";
import Footer from "./components/Footer.vue";
import ToolBar from "./components/ToolBar.vue"


</script>

<template class="">
 <header>
    <NavBar/>
   
 </header>

  <body class="bg-white pb-20 ">
     <RouterView />
     <ToolBar/>
     <Footer />
 
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
      isAdmin: false,
    };
  },

  methods: {
    async checkToken() {
      const token = localStorage.getItem("token");
      console.log('token',token);
      if (token) {
        const response = await fetch("http://127.0.0.1:8000/api/user",
        {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
                  
        })
        const user = await response.json();
        this.user = user;
        this.isAdmin = user.isadmin;
        this.isLoggedIn = true;
      }
    },
    login(token, user) {
      localStorage.setItem("token", token);
      this.isLoggedIn = true;
      this.user = user;
      this.isAdmin = user.isadmin == 1;
    },
    logout() {
      localStorage.removeItem("token");
      this.isLoggedIn = false;
      this.user = null;
    },
      async isAgreed(){
        const response = await fetch("http://127.0.0.1:8000/api/mailCracking",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
          },
        })
      }

  },

  mounted() {
    this.checkToken();
  },

  provide() {
    return {
      isAgreed: () => this.isAgreed,
      isLoggedIn: () => this.isLoggedIn,
      isAdmin: () => this.isAdmin,
      getUser: () => this.user,
      loginUser: this.login,
      logoutUser:  this.logout,
    };
  },
};
</script>

<style>
.main {
  margin-bottom: 30px; 
}
</style>



