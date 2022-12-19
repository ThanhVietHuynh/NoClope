<script setup>
  import {ref} from 'vue';
  const showUpdateProfile = ref(true);
  </script>

<script>

export default{
  
  data(){
    return{
      profil:[],
      lastname:"",
      firstname:"",
      email:"",
      password:"",
      feedbackMessage:"",
    };
  },

  methods: {
    async getProfil(){
      let tokens = localStorage.getItem("token");
      const response = await fetch(`http://127.0.0.1:8000/api/profil`, {
        method:"GET",
        headers:{
          "Accept":"application/json",
          Authorization: `Bearer ${tokens}`,
        }
      });

      const data = await response.json();
     
      this.profil = data.profil;
    },

    async updateProfil(){
        const body = {   
            lastname: this.lastname,
            firstname: this.firstname,
            email: this.email,
            password: this.password,

        }
        let tokens = localStorage.getItem("token");
        const response = await fetch(`http://127.0.0.1:8000/api/profil`,{
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                Authorization: `Bearer ${tokens}`,
            },
            body: JSON.stringify(body)
        });

        const data = await response.json();

        this.feedbackMessage = data.message;
        this.getProfil();
    }
  },
  mounted(){
    this.getProfil();
  }
};
</script>

<template>
  
  <section class="flex items-center justify-center">
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
      <h2 class="text-center">Mon Profil
      </h2>
      <p>{{profil.lastname}} {{profil.firstname}}</p>
      <p>Email: {{profil.email}}</p>
      <button type="submit" @click="showUpdateProfile =! showUpdateProfile" class="
     "><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
 <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
</svg>
</button> 
      
    </div>
  </section>

  <section class="flex items-center justify-center" :class="{hidden: showUpdateProfile}" >
  <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
  <form @submit.prevent="updateProfil">
    <div class="form-group mb-6">
      <h2>Modifier le profil</h2>
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail2"
        aria-describedby="emailHelp" placeholder="Nouveau Nom">
    </div>
    <div class="form-group mb-6">
      <input v-model="firstname" type="text" class="form-control block
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
        placeholder="Prénom">
    </div>
    <div class="form-group mb-6">
      <input v-model="email" type="email" class="form-control block
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
        placeholder="Nouvel email">
    </div>
    <div class="form-group mb-6">
      <input v-model="password" type="password" class="form-control block
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
        placeholder="Mot de passe">
    </div>
  
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
      active:bg-teal-600 active:shadow-lg
      transition
      duration-150
      ease-in-out">Valider</button>
    
  </form>
</div>
 </section>

</template>