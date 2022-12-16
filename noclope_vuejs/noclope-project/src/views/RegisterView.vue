<script setup>

import { def } from '@vue/shared';
import Register from '../components/Register.vue';
</script>

<script>
  export default {
    data(){
      return{
        infoproject:{},
        firstname: "",
        lastname: "",
        email: "",
        password: "",
        feedbackMessage:"",
      };
    },
    methods: {
      getProject(){
        console.log("coucou")
        const infoproject=JSON.parse(localStorage.getItem('infoproject'));
        console.log(infoproject);
        this.infoproject=infoproject;
        console.log(this.infoproject);

    },

    async createUser() {
      const body = {
        lastname: this.lastname,
        firstname: this.firstname,
        email: this.email,
        password: this.password,
        goal: this.infoproject.goal,
        price_goal: this.infoproject.price_goal,
        price_pack: this.infoproject.price_pack,
        consumption: this.infoproject.consumption
      }


      const response = await fetch("http://127.0.0.1:8000/api/register",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
          },

          body: JSON.stringify(body)
        });

      

      const data = await response.json();
 
      if(response.status !== 200 || !data.url) {
        this.feedbackMessage = data.message;
        return;
      }

      console.log(data.url);
      window.location.assign(data.url);
      localStorage.setItem("token", data.access_token);

    }
  },

  mounted() {
    this.getProject();
  },
}
</script>

<template>
  <p>{{feedbackMessage}}</p>

  <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
  <h1>Récapitulatif du projet</h1>
  <ul>
    <!-- <li v-for = "item in infoproject" > -->
    <p>Objectif: {{ infoproject.goal }} pour un montant de {{ infoproject.price_goal }}€</p>
    <p>Informations saisies :</p>
    <p>Consommation journalière: {{ infoproject.consumption }}cigarettes/jour</p>
    <p>Prix d'un paquet de cigarette: {{ infoproject.price_pack }}€</p>
    <!-- <p>Nom: {{contact.lastname}}</p>
          <p>Numéro de téléphone: {{contact.number_phone}}</p> -->
    <!-- </li> -->
  </ul>
</div>

  <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
  <form @submit.prevent="createUser">
    <div class="grid grid-cols-2 gap-4">
      <div class="form-group mb-6">
        <input v-model="lastname" type="text" class="form-control
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
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput123"
          aria-describedby="emailHelp123" name="nom" placeholder="Nom">
      </div>
      <div class="form-group mb-6">
        <input v-model="firstname" type="text" class="form-control
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
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput124"
          aria-describedby="emailHelp124" name="prenom" placeholder="Prénom">
      </div>
    </div>
    <div class="form-group mb-6">
      <input type="email" v-model="email" name="email" class="form-control block
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput125"
        placeholder="Adresse mail">
    </div>
    <div class="form-group mb-6">
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput126"
        placeholder="Mot de passe">
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
      ease-in-out">Créer un compte</button>
  </form>
</div>
</template>

<style scoped>
h1 {
  text-align: center;
  border-bottom: 4px solid gray;
}

</style>
