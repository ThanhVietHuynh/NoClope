<script setup>
import { def } from "@vue/shared";
import Register from "../components/Register.vue";
import * as dayjs from "dayjs";
import "dayjs/locale/fr"; // import locale
</script>

<script>
export default {
  data() {
    return {
      project: {},
      cracking: {},
      finished_at: "",
      progression: "",
      number_day_end: "",
      savings: 0,
      number_cig_smoked: 0,
      number_cig_non_smoked: 10,
      saving_now: 0,
      price_cigarette: 0,
      date: "",
      number_cig_smoked_today: 0,
    };
  },
  methods: {
    //Requete pour avoir les informations du projet
    async getProject() {
      let tokens = localStorage.getItem("token");
      const response = await fetch("http://127.0.0.1:8000/api/project", {
        method: "GET",
        headers: {
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
      });
      const data = await response.json();
      this.project = data.projects[0];
    },

    //Requete pour avoir les informations de crackings
    async getCrakings() {
      let tokens = localStorage.getItem("token");
      const response = await fetch("http://127.0.0.1:8000/api/cracking", {
        method: "GET",
        headers: {
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
      });
      const data = await response.json();
      this.cracking = data.cracking;
      this.number_cig_smoked = data.number_cig_smoked; //donne le nombre total de cigarette fumées depuis le début du projet

      await this.getProject();
      console.log(this.project.consumption);

      //Calcul de la date de fin
      //Calcul du nombre de jours restant
      this.price_cigarette = this.project.price_pack / 20; //20 est le nombre de cigarette dans un paquet
      var price_daily = this.price_cigarette * this.project.consumption;
      // var number_day=this.project.price_goal/price_daily
      var number_day =
        (this.project.price_goal +
          this.number_cig_smoked * this.price_cigarette) /
        price_daily;

      var date = new Date(this.project.created_at);
      var dateTime = date.getTime();
      // 60 secondes * 60 minutes * 24 heures
      // On multiplie par 1000 car le time est exprimé en millisecondes
      var endTime = dateTime + number_day * 60 * 60 * 24 * 1000;

      var endDate = new Date(endTime);
      this.finished_at = endDate;
      this.project.created_at = dayjs(this.project.created_at)
        .locale("fr")
        .format("DD/MM/YYYY"); // '25/01/2019'
      this.finished_at = dayjs(this.finished_at)
        .locale("fr")
        .format("DD/MM/YYYY"); // '25/01/2019'

      //Calcul de la progression
      var currentDate = new Date();
      var number_day_now = (currentDate - dateTime) / (60 * 60 * 24 * 1000);
      var progression_percent = (number_day_now / number_day) * 100;
      this.progression = progression_percent.toFixed(2);

      //Permet de ne pas avoir un objectif négatif
      if (this.progression < 0) {
        this.progression = 0;
      }

      //Permet de ne pas avoir un objectif qui dépasse les 100%
      if (this.progression >= 100) {
        this.progression = 100;
      }

      //Nombre de jours restants
      this.number_day_end = (number_day - number_day_now).toFixed(0);

      //Economies réalisées
      // Foreach qui met les cigarettes fumées égal à la consommation pour ne pas que le calcul d'économie passe négatif
      this.cracking.forEach((element) => {
        if (element["number_smoked_cigarette"] >= this.project.consumption) {
          element["number_smoked_cigarette"] = this.project.consumption;
        }
      });
      //Met dans un tableau le nombre de cigarettes fummées qui correspondent à la date d'aujourd'hui
      var j = [];
      this.cracking.forEach((element) => {
        j.push(element["number_smoked_cigarette"]);
      });

      //Additionne les valeurs du tableau
      const initialValuej = 0;
      this.number_cig_smoked2 = j.reduce(
        (accumulator, currentValue) => accumulator + currentValue,
        initialValuej
      );
      console.log(this.consumption);

      this.savings = (
        (number_day_now * this.project.consumption - this.number_cig_smoked2) *
        this.price_cigarette
      ).toFixed(0);

      //Calcul pour savoir si aujourd'hui il y a eu un crakage => OBJECTIF JOURNALIER
      var date_today = dayjs(new Date()).locale("fr").format("DD/MM/YYYY"); //date d'aujourd'hui au format DD/MM/YYYY

      //Met dans un tableau le nombre de cigarettes fummées qui correspondent à la date d'aujourd'hui
      var i = [];
      this.cracking.forEach((element) => {
        var date_cracking = dayjs(element["date_cracking"])
          .locale("fr")
          .format("DD/MM/YYYY");
        if (date_cracking == date_today) {
          i.push(element["number_smoked_cigarette"]);
        }
      });

      //Additionne les valeurs du tableau
      const initialValue = 0;
      this.number_cig_smoked_today = i.reduce(
        (accumulator, currentValue) => accumulator + currentValue,
        initialValue
      );

      //Objectif journalier
      this.number_cig_non_smoked =
        this.project.consumption - this.number_cig_smoked_today;
      this.saving_now = this.number_cig_non_smoked * this.price_cigarette;
    },
  },

  mounted() {
    this.getProject();
    this.getCrakings();
  },
};
</script>

<template>
  <section class="flex align-center justify-center">
    <div class="block p-6 rounded-lg shadow-lg bg-white w-2/4 w-full">
      <div class="flex flex align-center justify-center">
        <div class="flex-col">
          <h2 class="text-center" >Je veux {{ project.goal }} pour {{ project.price_goal }}€</h2>
          <div class="progression">
            <div class="progression2" :style="'width: ' + progression + '%'">
              {{ progression }}%
            </div>
          </div>
          <div class="flex justify-between">
            <div class="justify-start">{{ project.created_at }}</div>
            <div class="justify-end">{{ finished_at }}</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="flex align-center justify-center justify-around">
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
      <div>
        Nombre de cigarettes fumées depuis le début du projet :
        {{ number_cig_smoked }}
      </div>
      <div>Nombre de jours restants : {{ number_day_end }}</div>
    </div>
 
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
      <h1>Economies réalisées : {{ savings }}€</h1>
      <h1>Objectif journalier :</h1>
      <h2>Nombre de cigarette fumées : {{ number_cig_smoked_today }}</h2>
      <h2>Nombre de cigarette non-fumées : {{ number_cig_non_smoked }}</h2>
      <h2>Economie aujourd'hui : {{ saving_now }}€</h2>
    </div>
</div>

</template>

<style scoped>
.progression {
  border: 1px solid grey;
  width: 400px;
  height: 30px;
  border-radius: 5px;
}
.progression2 {
  background-color: blue;
  height: 30px;
  border-radius: 5px;
}
</style>
