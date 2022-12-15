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

        window.location.assign('home')

        // localStorage.setItem("token", data.access_token);
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

    <section class="flex items-center justify-center" >
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
  <form @submit.prevent="loginUser">
    <div class="form-group mb-6">
      <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">Adresse mail</label>
      <input type="email" name="email" v-model="email" class="form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail2"
        aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group mb-6">
      <label for="exampleInputPassword2" class="form-label inline-block mb-2 text-gray-700">Mot de passe</label>
      <input v-model="password" name="password" type="password" class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword2"
        placeholder="Password">
    </div>
    <div class="flex justify-between items-center mb-6">
      <div class="form-group form-check">
        <input type="checkbox"
          class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
          id="exampleCheck2">
        <label class="form-check-label inline-block text-gray-800" for="exampleCheck2">Se souvenir de moi</label>
      </div>
      <a href="#!"
        class="text-blue-600 hover:text-blue-700 focus:text-blue-700 transition duration-200 ease-in-out">Mot de passe oublié ?</a>
    </div>
    <button type="submit" class="
      w-full
      px-6
      py-2.5
      bg-blue-600
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-blue-700 hover:shadow-lg
      focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-150
      ease-in-out">Se connecter</button>
    <p class="text-gray-800 mt-6 text-center">Vous n'avez pas de compte? <a href="#!"
        class="text-blue-600 hover:text-blue-700 focus:text-blue-700 transition duration-200 ease-in-out">S'inscrire</a>
    </p>
  </form>
</div>
    </section>
</template>