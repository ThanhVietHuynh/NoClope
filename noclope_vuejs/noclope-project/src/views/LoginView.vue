<script setup>

</script>
<script>
  export default {
    data(){
      return{
        email: "",
        password: "",
      };
    },
    methods: {
      async loginUser(){
        const body = {
          email: this.email,
          password: this.password,
        }
        console.log(body);
        
        const response = await fetch("http://127.0.0.1:8000/api/login",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
          
          },
          
          body: JSON.stringify(body)
         
        });

        

        const data = await response.json();
        

        }
      }

    }
</script>

<template>
    <h1>Se connecter</h1>
    <form action="" method="" @submit.prevent="loginUser">
        <p>
            <label for="email">Email : 
                <input type="text" name="email" id="email" v-model="email">
            </label>
        </p>
        <p>
            <label for="password">Mot de passe : 
                <input type="password" name="password" id="password" v-model="password">
            </label>
        </p>
        <p>
            <button type="submit">Se connecter</button>
        </p>

    </form>
</template>