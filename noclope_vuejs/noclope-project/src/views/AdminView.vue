<script setup>
import dayjs from "dayjs";
import "dayjs/locale/fr";
</script>
<script>
export default{
    data(){
      return{
        users:[],

      };
    },

    methods: {
    async getUsers(){
      let tokens = localStorage.getItem("token");
      const response = await fetch("http://127.0.0.1:8000/api/admin", {
        method:"GET",
        headers:{
          "Accept":"application/json",
          Authorization: `Bearer ${tokens}`,
        }
      });

      const data = await response.json();   
      this.users = data.users;
     
    },
    },
    mounted(){
        this.getUsers();
    }

}

</script>

<template>

<div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <h1 class="text-sm font-medium text-gray-900 px-6 py-4">Liste des utilisateurs</h1> 
        <table class="min-w-full">
          <thead class="border-b"> 
            <tr>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Nom
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Prénom
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Email
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Date d’inscription
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Avancement de l’objectif
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b" v-for="user in users">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{user.lastname}}
            </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{user.firstname}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{user.email}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{dayjs(user.created_at).locale("fr").format("DD/MM/YYYY")}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</template>

<style>
caption {
  display: table-caption;
  text-align: center;
  text-align:right
}
</style>