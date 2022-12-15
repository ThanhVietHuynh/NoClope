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
    
  <p>{{feedbackMessage}}</p>
  
  <section>
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
      <h2>Mon Profil</h2>
      <p>{{profil.lastname}} {{profil.firstname}}</p>
      <p>Email: {{profil.email}}</p>
    </div>
  </section>
  
  <!-- <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
    <form class="form" @submit.prevent="updateProfil">
      <h2>Modifier le profil</h2>
      <p class="pContact" type="Nom:"><input type="text" class="inputContact" v-model="lastname" placeholder="Nouveau nom"></p>
      <p class="pContact" type="Prénom:"><input type="text" class="inputContact" v-model="firstname"  placeholder="Nouveau prénom"></p>
      <p class="pContact" type="Email:"><input type="email" class="inputContact" v-model="email"  placeholder="Votre nouveau email"></p>
      <p class="pContact" type="Mot de passe:"><input type="password" class="inputContact" v-model="password"  placeholder="Nouveau Mot de passe"></p>
      <button class="btn" type="submit">Valider</button>
    </form>
  </div> -->

  <section class="flex items-center justify-center" >
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
      ease-in-out">Valider</button>
    
  </form>
</div>
 </section>

</template>