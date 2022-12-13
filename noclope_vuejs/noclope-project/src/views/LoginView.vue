<script setup>

</script>
<script>
  export default {
    data(){
      return{
        email: "",
        password: "",
        feedbackMessage:"",
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
          
         
        })

        const data = await response.json();

        this.feedbackMessage = data.message;

        localStorage.setItem("token", data.access_token);

        // console.log(data)

      //   if (data.success == true) {
      //       // Mise dans le local storage
      //       localStorage.setItem("tokenUserLog", JSON.stringify(this.infoUser.token));
 
      // }    
      if(response.status === 201){
        localStorage.setItem("token", data.access_token)
          return this.$router.push("/edit");
        }else if(response.status === 400){
          console.log(response, 'Mot de passe ou email incorrect');
        }
        }
      }

    }
</script>

<template>
    <p>{{feedbackMessage}}</p>

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