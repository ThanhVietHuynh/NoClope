<script>

export default {
  data() {
    return {
      goal: "",
      price_goal: "",
      price_pack: "",
      consumption: "",
      result: null,
      token: "",
    };
  },

  methods: {
   
    getProjects: function () {
      const infoproject = {
        goal: this.goal,
        price_goal: this.price_goal,
        price_pack: this.price_pack,
        consumption: this.consumption,
      };

      // Condition regex string pour goal
      console.log(infoproject);
      localStorage.setItem("infoproject", JSON.stringify(infoproject));
  },
  showButton: function () {
        
        if(this.goal==""|this.goal==null|this.price_goal==""|this.price_goal==null|this.price_pack==""|this.price_pack==null|this.consumption==""|this.consumption==null){
          return false
        }else{
          return true;
        }
      },

},
mounted(){
// const project = localStorage.getItem("infoproject")
// if(project){
//   const parsed = JSON.parse(project)
//   this.goal= parsed.goal;
//   this.price_goal= parsed.price_goal;
//   this.price_pack= parsed.price_pack;
//   this.consumption= parsed.consumption;
// }else{}

}

}

</script>

<template>
  <section>
    <form class="form" @submit.prevent="getProjects()">
      <h2>Créer mon objectif</h2>
      <p type="Mon objectif:">
        <input type="text" required v-model="goal" placeholder="Entrez votre objectif" />
      </p>
      <p type="Son prix:">
        <input min="50" type="number" required v-model="price_goal" placeholder="Entrez son prix" />
      </p>
      <p type="Prix paquet cigarette:">
        <input min="2" type="number" required v-model="price_pack" placeholder="Entrez le prix d'un paquet" />
      </p>
      <p type="Ma consommation:">
        <input type="number"
          min="1"
          required
          v-model="consumption"
          placeholder="Entrez votre consommation journalière"
        />
      </p>
      
      <button v-if="showButton()" type="submit" class="input-submit" @click="$router.push('/register')" value="Créer mon objectif">
        Se Lancer</button>
        
    </form>
  </section>

</template>

<style scoped>
header {
  line-height: 1.5;
}

h2{
  margin-top: 10px;
}

form{
  display: flex;
  flex-direction: column;
  align-items: center;
}

input{
  margin: 5px;
  border-radius: 5px;
}
.error {
  margin-top: 20px;
  padding: 10px;
  color: #b42f26;
}
.input-submit{
  margin: 10px;
cursor: pointer;
background-color: aliceblue;
border-radius: 5px;
width: 90px;
height: 30px;
}
@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }
}

</style>
