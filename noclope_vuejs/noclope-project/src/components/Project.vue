<script>
export default {
  data() {
    return {
      projects: [],
    };
  },

  methods: {
    async getProjects() {
      const response = await fetch("http://127.0.0.1:8000/api/project", {
        method: "GET",
        headers: {
          Accept: "application/json",
        },
      });

      const data = await response.json();

      this.projects = data.projects;
    },
    async createProject() {
      const body = {
        goal: this.goal,
        price_goal: this.price_goal,
        price_pack: this.price_pack,
        consumption: this.consumption,
      };
      const response = await fetch("http://127.0.0.1:8000/api/project", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify(body),
      });

      const data = await response.json();

      this.feedbackMessage = data.message;
      this.getProjects();
    },
  },

  mounted() {
    this.getProjects();
  },
};
</script>

<template>
  <section>
    <form class="form" @submit.prevent="createProject">
      <h2>Créer mon objectif</h2>
      <p type="Mon objectif:">
        <input v-model="goal" placeholder="Entrez votre objectif" />
      </p>
      <p type="Son prix:">
        <input v-model="price_goal" placeholder="Entrez son prix" />
      </p>
      <p type="Prix paquet cigarette:">
        <input v-model="price_pack" placeholder="Entrez le prix d'un paquet" />
      </p>
      <p type="Ma consommation:">
        <input
          v-model="consumption"
          placeholder="Entrez votre consommation journalière"
        />
      </p>
      <button class="btn" type="submit">Valider</button>
    </form>
    <p>{{ feedbackMessage }}</p>
  </section>

  <section>
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
  </section>
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
