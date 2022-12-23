<script setup lang="ts">
    import Chart, { ChartConfiguration, ChartItem } from 'chart.js/auto';
    import { onMounted } from 'vue';

    const labels = [
        'Janvier',
        'Fevrier',
        'Mars',
        'Avril',
        'Mai',
        'Juin',
        'Juillet',
        'Août',
        'Septembre',
        'Octobre',
        'Novembre',
        'Decembre',
    ];

    const data ={
        labels: labels,
        datasets: [
        {
            label: 'Nombre d\'utilisateur',
            backgroundColor:'rgb(20,170,255)',
            borderColor:'rgb(20,170,255)',
            data:[5,10,5,2,20,15,25,25,28,21,29,35]
        },
        {
            label: 'Total des économies réalisées',
            backgroundColor:'rgb(255,110,51)',
            borderColor:'rgb(255,110,51)',
            data:[0,5,9,12,25,32,26,39,25,27,30,50]
        },
        {
            label: 'Nombre de cigarettes fumées',
            backgroundColor:'rgb(153,51,255)',
            borderColor:'rgb(153,51,255)',
            data:[30,25,10,18,20,20,23,28,32,50,45,48]
        }
        
    ]
    };

    const config: ChartConfiguration = {
        type: 'line',
        data: data,
        options:{}
    };

    onMounted(() => {
        const canvasTag = <ChartItem>document.getElementById('myChart')
        new Chart (
            canvasTag,
            config
        )

    })



</script>

<template>
    <div>
        <canvas id="myChart" height="300" width="800"></canvas>
    </div>
</template>


