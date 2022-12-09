<script setup>

import { def } from '@vue/shared';
import Register from '../components/Register.vue';
</script>

<script>
  export default {
    data(){
      return{
        firstname: "",
        lastname: "",
        email: "",
        password: "",
      };
    },
    methods: {
      async createUser(){
        const body = {
          lastname: this.lastname,
          firstname: this.firstname,
          email: this.email,
          password: this.password,
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

        console.log(response);

        const data = await response.json();
        

        }
      }

    }
</script>

<template>
  <h1>Formulaire d'inscription</h1>
  <form class="formulaire" action="" method="" @submit.prevent="createUser">
    <p>
      <label for="nom"
        >Nom :
        <input type="text" name="nom" id="nom" placeholder="Nom..." v-model="lastname"/>
      </label>
    </p>
    <p>
      <label for="prenom"
        >Prénom :
        <input type="text" name="prenom" id="prenom" placeholder="Prénom..." v-model="firstname" />
      </label>
    </p>
    <p>
      <label for="email"
        >Email :
        <input type="email" name="email" id="email" placeholder="Email..." v-model="email" />
      </label>
    </p>
    <p>
      <label for="password"
        >Mot de passe :
        <input type="password" name="password" id="password" placeholder="Mot de passe..." v-model="password" />
      </label>
    </p>
    <!-- <p>
      <label for="confirm"
        >Confirmer votre mot de passe :
        <input type="password" name="confirm" id="confirm" placeholder="Confirmer mot de passe..." />
      </label>
    </p> -->
    <button type="submit">S'enregistrer</button>
  </form>
</template>

<style scoped>
h1 {
  text-align: center;
  border-bottom: 4px solid gray;
}
.formulaire input {
  margin: 20px;
}

form {
  text-align: center;
  border-radius: 15px;
}

button{
    border: none;
    font-size: large;
    background-color: rgb(88, 87, 87);
    color: white;
    border-radius: 10px;
    padding: 5px;

}

button:hover{
    background-color: gray;
    transition: 200ms;
    cursor: pointer;
}
</style>
