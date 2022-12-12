<script>
export default {
  data() {
    return {
      // projects: [],
      goal: "",
      price_goal: "",
      price_pack: "",
      consumption: "",
      result: null,
      token: "",
    };
  },

  methods: {
    async objectif() {
      const options = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          goal: this.goal,
          price_goal: this.price_goal,
          price_pack: this.price_pack,
          consumption: this.consumption,
        }),
      };

      const response = await fetch(
        "http://127.0.0.1:8000/api/project",
        options
      );

      const data = await response.json();

      this.result = data.success;
      if (data.success === true) {
        this.token = data.token;
        localStorage.setItem("token", data.token);
        this.$router.push("/register");
      }
    },
    //   async getProjects() {
    //     const response = await fetch("http://127.0.0.1:8000/api/project", {
    //       method: "GET",
    //       headers: {
    //         Accept: "application/json",
    //       },
    //     });

    //     const data = await response.json();

    //     this.projects = data.projects;
    //   },
    //   // async createProject() {
    //   //   const body = {
    //   //     goal: this.goal,
    //   //     price_goal: this.price_goal,
    //   //     price_pack: this.price_pack,
    //   //     consumption: this.consumption,
    //   //   };
    //   //   const response = await fetch("http://127.0.0.1:8000/api/project", {
    //   //     method: "POST",
    //   //     headers: {
    //   //       "Content-Type": "application/json",
    //   //       "Accept": "application/json",
    //   //     },
    //   //     body: JSON.stringify(body),
    //   //   });

    //   //   const data = await response.json();

    //   //   this.feedbackMessage = data.message;
    //   //   this.getProjects();
    //   // },
  },

  // mounted() {
  //   this.getProjects();
  // },
};
</script>

<template>
  <section>
    <form class="form" @submit.prevent="objectif">
      <h2>Créer mon objectif</h2>
      <p type="Mon objectif:">
        <input required v-model="goal" placeholder="Entrez votre objectif" />
      </p>
      <p type="Son prix:">
        <input required v-model="price_goal" placeholder="Entrez son prix" />
      </p>
      <p type="Prix paquet cigarette:">
        <input v-model="price_pack" placeholder="Entrez le prix d'un paquet" />
      </p>
      <p type="Ma consommation:">
        <input
          required
          v-model="consumption"
          placeholder="Entrez votre consommation journalière"
        />
      </p>

      <RouterLink to="/register">
        <p v-if="result === true"></p>
        <p v-else-if="result === false" class="error">
          Votre projet est invalide
        </p>
      </RouterLink>

      <button type="submit" @click="$router.push('/register')" class="input-submit" value="Créer mon objectif">Créer mon objectif</button>
    </form>
  </section>

  <!-- <section>
    <div>
      <h2>Mon Projet</h2>
      <ul>
        <li v-for="project in projects" :key="project.id">
          <p>Mon objectif : {{ project.goal }}</p>
          <p>Son prix : {{ project.price_goal }}</p>
          <p>Prix paquet cigarette : {{ project.price_pack }}</p>
          <p>Ma consommation : {{ project.consumption }}</p>
        </li>
      </ul>
    </div>
  </section> -->
</template>

<style scoped>
header {
  line-height: 1.5;
}
.error {
  margin-top: 20px;
  padding: 10px;
  color: #b42f26;
}
@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }
}
</style>
