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
        isprojet:false,
      };
    },
    methods: {
      getProject(){
        const infoproject=JSON.parse(localStorage.getItem('infoproject'));
        if(infoproject==null){
            this.isprojet=true;
        }
        this.infoproject=infoproject;

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
      
      window.location.assign(data.url);

    }
  },

  mounted() {
    this.getProject();
  },
}
</script>

<template>
  <section class="flex items-center justify-center" >
  <p>{{feedbackMessage}}</p>

  <div class="flex align-center justify-center w-fit">
    
    <div class="block p-6 rounded-lg shadow-lg bg-teal-400 max-w-sm  my-8">
      <div>
        <h2 class="text-sky-900 text-2xl font-semibold">Votre projet</h2>
        <p class="text-sky-900 text-l mb-4 font-semibold">{{ infoproject.goal }} <br> pour {{ infoproject.price_goal }}€</p>
      </div>
      <div class="flex justify-around mt-2.5">
        <div class="bg-white shadow-lg text-center w-24 rounded-lg m-1 transition-transform hover:scale-105">
          <!-- <p class="text-sky-900">Votre conso</p> -->
          <p class="text-xl text-sky-900 ">{{ infoproject.consumption }} clop <br> par jour</p>
        </div>
        <div class="bg-white shadow-lg text-center w-24 rounded-lg m-1 transition-transform hover:scale-105">
          <!-- <p class="text-sky-900">Vous achetez</p> -->
          <p class="text-xl text-sky-900">
            {{ infoproject.price_pack }}€ <br> 
            le paquet
          </p>
        </div>
        <div class="bg-white shadow-lg text-center w-24 rounded-lg m-1 transition-transform hover:scale-105">
          <p class="text-xl text-sky-900">{{ savings }} €</p>
          <p class="text-sky-900">Economisés</p>
        </div>
      </div>
    </div>
  </div>


  </section>

<section class="flex items-center justify-center" >
  <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
  <form @submit.prevent="createUser">
    <h1 class="text-sky-900 text-xl mb-4 text-center font-semibold">Créer un compte</h1>
    <p v-if="isprojet" class="text-red-500 mt-2 text-m font-semibold text-center mb-3">
      Vous devez créer un projet pour vous inscrire</p>
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
          focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInput123"
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
          focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInput124"
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
        focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInput125"
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
        focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInput126"
        placeholder="Mot de passe">
    </div>
    <p class="text-red-500 mt-2 text-m font-semibold text-center mb-3">
      {{feedbackMessage}}
    </p>
    <button type="submit" class="
      w-full
      px-6
      py-2.5
      bg-teal-500
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-teal-400 hover:shadow-lg
      focus:bg-teal-400 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-teteal00 active:shadow-lg
      transition
      duration-150
      ease-in-out">Créer un compte</button>
  </form>
</div>
</section>
</template>


