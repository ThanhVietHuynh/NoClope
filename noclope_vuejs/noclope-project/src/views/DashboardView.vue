<script setup>

import { def } from '@vue/shared';
import Register from '../components/Register.vue';
import * as dayjs from 'dayjs'
import 'dayjs/locale/fr' // import locale
</script>

<script>
export default {
    data() {
        return {
            project: {},
            finished_at:"",
            progression:"",

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
        console.log( this.project)
        
        //Calcul de la date de fin 
        var price_cigarette=this.project.price_pack/20; //20 est le nombre de cigarette dans un paquet
        var price_daily=price_cigarette*this.project.consumption;
        var number_day=this.project.price_goal/price_daily
        
        var date = new Date(this.project.created_at);
        var dateTime = date.getTime();
        // 60 secondes * 60 minutes * 24 heures
        // On multiplie par 1000 car le time est exprimé en millisecondes
        var endTime = dateTime + (number_day*60*60*24) * 1000
        
        var endDate = new Date(endTime);
        console.log('datefin', endDate)
        this.finished_at=endDate;
        this.project.created_at=dayjs(this.project.created_at).locale('fr').format('DD/MM/YYYY') // '25/01/2019'
        this.finished_at=dayjs(this.finished_at).locale('fr').format('DD/MM/YYYY') // '25/01/2019'
        
        //Calcul de la progression
        var currentDate = new Date();
            console.log(currentDate);

        var number_day_now = (currentDate-dateTime)/(60*60*24*1000)
        var progression_percent=number_day_now/number_day*100
        this.progression=progression_percent.toFixed(2)
        console.log(this.progression)
    },
    
  
     

    },

    mounted() {
        
            this.getProject();
        },
}
</script>

<template>
    <h1>{{project.goal}}</h1>
    <h1>Objectif : {{project.price_goal}}€</h1>

    <div>Date de début : {{project.created_at}}</div>
    <div>Date de fin : {{finished_at}}</div>
    <div class="progression"><div  class="progression2"  :style="'width: ' + progression +'%'" >{{progression}}%</div>

        </div>

</template>

<style scoped>

.progression{
    border: 1px solid grey;
    width: 400px;
    height: 40px;
    border-radius: 5px;
}
.progression2{
    background-color: blue;
    height: 40px;
    border-radius: 5px;
}

</style>