<script setup>
import { def } from "@vue/shared";
import Register from "../components/Register.vue";
import * as dayjs from "dayjs";
import "dayjs/locale/fr"; // import locale
import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'
import FireworksJSON from '../assets/7393-fireworks.json'



</script>

<script>

export default {
  components: {
    Vue3Lottie,
  },
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
      FireworksJSON,
      fireworks:false,
      
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
      this.saving_now = (this.number_cig_non_smoked * this.price_cigarette).toFixed(0);
      //Permet de savoir si l'objectif est réalisé
      if(this.progression>=100){
        this.fireworks=true;
      } else {
        this.fireworks=false;
      }
    },


  },

  mounted() {
    this.getProject();
    this.getCrakings();
    // src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js";
  },
};
</script>

<template>
  <section v-if="!fireworks" class="flex align-center justify-center">
    <div class="block p-6 rounded-lg shadow-lg bg-white w-full">
      <div class="flex align-center justify-center ">
        <div class="flex-col">
          <h2 class="text-center text-sky-900 text-xl font-semibold uppercase ">
            {{ project.goal }} 
          </h2>
          <p class=" text-center text-xl text-teal-400 font-semibold">
            J-{{ number_day_end }}
          </p>
          <div class="flex justify-between">
            <div class="justify-start"> 
             <p class="text-teal-400 text-xl font-semibold ml-2.5">{{ savings }}€</p>
             <p class="text-teal-400 text-lg ml-2.5">cagnotté</p>
            </div>
            <div class="justify-end mr-2.5">
              <p class="text-xl font-semibold text-right  text-sky-900">{{ project.price_goal }}€</p>
              <p class="text-lg text-sky-900">montant final</p>
            </div>
          </div>
          <div class="progression bg-stone-100 h-2.5 w-96 rounded-lg">
            <div class="progression2 text-transparent bg-teal-400 h-2.5 rounded-lg" :style="'width: ' + progression + '%'">
            </div>
          </div>
          <!-- <div class="flex justify-between">
            <div class="justify-start ml-2.5">{{ project.created_at }}</div>
            <div class="justify-end mr-2.5">{{ finished_at }}</div>
          </div> -->
        </div>
      </div>
    </div>
  </section>

  <section v-if="!fireworks" class="flex justify-around flex-wrap">
  <div class="flex align-center justify-center w-fit">
    <div class="block p-6 rounded-lg shadow-lg bg-teal-400 max-w-sm  my-8">
      <div>
        <h2 class="text-sky-900 text-2xl font-semibold">Mon parcours</h2>
      </div>
      <div class="flex justify-around mt-2.5">
        <div class="bg-white shadow-lg text-center w-24 rounded-lg m-1 transition-transform hover:scale-105">
          <p class="text-xl text-sky-900 ">{{ number_cig_smoked }}</p>
          <p class="text-sky-900">Craquage</p>
        </div>
        <div class="bg-white shadow-lg text-center w-24 rounded-lg m-1 transition-transform hover:scale-105">
          <p class="text-xl text-sky-900">
            {{ number_day_end }}
          </p>
          <p class="text-sky-900">Jours restants</p>
        </div>
        <div class="bg-white shadow-lg text-center w-24 rounded-lg m-1 transition-transform hover:scale-105">
          <p class="text-xl text-sky-900">{{ savings }} €</p>
          <p class="text-sky-900">Economisés</p>
        </div>
      </div>
    </div>
  </div>

    <div class="flex align-center justify-center w-fit ">
      <div class="block p-6 rounded-lg shadow-lg bg-teal-400 max-w-sm w-fit my-8">
        <div>
          <h2 class="text-sky-900 text-2xl font-semibold font-sans">Objectif journalier</h2>
        </div>
        <div class="flex justify-around mt-2.5">
          <div class="bg-white shadow-lg text-center w-24 rounded-lg m-1 transition-transform hover:scale-105">
            <p class="text-xl text-sky-900">{{ number_cig_smoked_today }}</p>
            <p  class="text-sky-900">Craquage</p>
          </div>
          <div class="bg-white shadow-lg text-center w-24 rounded-lg m-1 transition-transform hover:scale-105">
            <p class="text-xl text-sky-900">
              {{ number_cig_non_smoked }}
            </p>
            <p class="text-sky-900">cigarette non-fumées</p>
          </div>
          <div class="bg-white shadow-lg text-center w-24 rounded-lg m-1 transition-transform hover:scale-105">
            <p class="text-xl text-sky-900">{{ saving_now }} €</p>
            <p class="text-sky-900">Economisés</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Si le projet est fini (progression=100) affiche cette div avec le récap -->
<div v-if="fireworks" class="w-auto">
  <Vue3Lottie :animationData="FireworksJSON"  class="w-auto" />
  <button type="submit" class="
      absolute 
      overflow-hidden 
      inset-1/3
      w-auto
      h-min
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
      active:bg-teal-400 active:shadow-lg
      transition
      duration-150
      ease-in-out">BRAVO! Vous avez fini votre projet et allez pouvoir vous offrir : {{ project.goal }} </button>

</div>




</template>





<style>
*{
  box-sizing: border-box;
}
</style>

