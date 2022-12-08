<script>
export default{
  name:"App",
  
  data(){
    return{
        project:[],
    };
  },

  methods: {
    async getProject(){
      const response = await fetch("http://127.0.0.1:8000/api/project", {
        method:"GET",
        headers:{
          "Accept":"application/json"
        }
      });

      const data = await response.json();
     
      this.project = data.project;
    },
  },
  mounted(){
    this.getProject();
  }
};
</script>

<template>
  <div>
    <h2>Mon Projet</h2>
    <ul>
      <li v-for ="project in project" :key ="project.id"></li>
      <p>Mon objectif : {{project.goal}}</p>
      <p>Son prix : {{project.price_goal}}</p>
      <p>Prix paquet cigarette : {{project.price_pack}}</p>
      <p>Ma consommation : {{project.consumption}}</p>
    </ul>
  </div>

  <button @click="getProject">Afficher le projet</button>

</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
