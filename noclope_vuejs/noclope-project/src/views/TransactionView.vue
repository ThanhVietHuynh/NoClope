<script setup>
import * as dayjs from 'dayjs'
import 'dayjs/locale/fr' // import locale

</script>

<script>
export default {
    data() {
        return {
            transactions: [],
            sum:0,


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
            this.sum=data.sum
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
    

    <div>


        <div v-for="item in this.transactions" :key="transactions.id">
            <h1>Montant débité : {{ item.amount }} €</h1>
            <p>Le {{ item.date_transaction }} </p>
        </div>

        <div>
            <h1>Total des économies réalisées : {{sum}} €</h1>
           
        </div>

     <form >
        <button type="submit" class="
      w-full
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
      ease-in-out">Demander le déblocage anticipé des fonds</button>
    
  </form>


    </div>

</template>

<style scoped>

</style>
