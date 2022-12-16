<script setup>
import * as dayjs from 'dayjs'
import 'dayjs/locale/fr' // import locale

</script>

<script>
export default {
    data() {
        return {
            transactions: [],


        };
    },
    methods: {

        async getTransactions() {
            let tokens = localStorage.getItem("token");
            const response = await fetch("http://127.0.0.1:8000/api/transaction", {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": `Bearer ${tokens}`,

                },
            });
            const data = await response.json();
            this.transactions = data.transactions
            this.transactions.forEach(element => {
                element.date_transaction = dayjs(element.date_transaction).locale('fr').format('DD/MM/YYYY')
            });


        },

        async createTransactions() {
            let tokens = localStorage.getItem("token");
            const response = await fetch("http://127.0.0.1:8000/api/transaction", {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    "Authorization": `Bearer ${tokens}`,

                },
            });
            const data = await response.json();
            console.log(data)



        },


    },
    mounted() {
        this.getTransactions();
        

    },
}
</script>

<template>
    <form @submit.prevent="createTransactions()">
        <button type="submit">GET PAIMENT</button>
    </form>

    <div>


        <div v-for="item in this.transactions" :key="transactions.id">
            <h1>Montant débité : {{ item.amount }} €</h1>
            <p>Le {{ item.date_transaction }} </p>
        </div>


    </div>

</template>

<style scoped>

</style>
