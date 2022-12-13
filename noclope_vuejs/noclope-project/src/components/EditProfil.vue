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
    <div>
      <h2>Mon Profil</h2>
      <p>Nom: {{profil.lastname}}</p>
      <p>Prénom: {{profil.firstname}}</p>
      <p>Email: {{profil.email}}</p>
    </div>
  </section>
  
  <form class="form" @submit.prevent="updateProfil">
      <h2>Modifier le profil</h2>
      <p class="pContact" type="Nom:"><input type="text" class="inputContact" v-model="lastname" placeholder="Nouveau nom"></p>
      <p class="pContact" type="Prénom:"><input type="text" class="inputContact" v-model="firstname"  placeholder="Nouveau prénom"></p>
      <p class="pContact" type="Email:"><input type="email" class="inputContact" v-model="email"  placeholder="Votre nouveau email"></p>
      <p class="pContact" type="Mot de passe:"><input type="password" class="inputContact" v-model="password"  placeholder="Nouveau Mot de passe"></p>
      <button class="btn" type="submit">Valider</button>
  </form>

</template>