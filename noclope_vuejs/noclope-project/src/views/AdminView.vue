<script setup>
import dayjs from "dayjs";
import "dayjs/locale/fr";
</script>
<script>
export default {
  data() {
    return {
      users: [],
      pourcentage: 0,
    };
  },

  methods: {
    async getUsers() {
      let tokens = localStorage.getItem("token");
      const response = await fetch("http://127.0.0.1:8000/api/admin", {
        method: "GET",
        headers: {
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
      });

      const data = await response.json();
      this.users = data.users;
      this.pourcentage = data.pourcentage;
      console.log(data);
    },
  },
  mounted() {
    this.getUsers();
  },
};
</script>

<template>
  <div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <h1 class="text-sm font-medium text-gray-900 px-6 py-4">
            Liste des utilisateurs
          </h1>
          <table class="min-w-full">
            <thead class="border-b">
              <tr>
                <th
                  scope="col"
                  class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                >
                  Nom
                </th>
                <th
                  scope="col"
                  class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                >
                  Prénom
                </th>
                <th
                  scope="col"
                  class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                >
                  Email
                </th>
                <th
                  scope="col"
                  class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                >
                  Date d’inscription
                </th>
                <th
                  scope="col"
                  class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                >
                  Objectif
                </th>
                <th
                  scope="col"
                  class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                >
                  Avancement de l’objectif
                </th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b" v-for="user in users">
                <td
                  class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                >
                  {{ user.lastname }}
                </td>
                <td
                  class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                >
                  {{ user.firstname }}
                </td>
                <td
                  class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                >
                  {{ user.email }}
                </td>
                <td
                  class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                >
                  {{ dayjs(user.created_at).locale("fr").format("DD/MM/YYYY") }}
                </td>
                <td
                  class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                >
                  {{ user.goal }} à {{ user.price_goal }} €
                </td>
                <td
                  class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                >
                  <p class="text-center text-xl text-teal-400 font-semibold">
                    J-10
                  </p>
                  <div class="flex justify-between">
                    <div class="justify-start">
                      <p class="text-teal-400 text-xl font-semibold ml-2.5">
                        0€
                      </p>
                      <p class="text-teal-400 text-lg ml-2.5">cagnotté</p>
                    </div>
                    <div class="justify-end mr-2.5">
                      <p class="text-xl font-semibold text-right text-sky-900">
                        {{user.price_goal}}€
                      </p>
                      <p class="text-lg text-sky-900">montant final</p>
                    </div>
                  </div>
                  <div class="progression bg-stone-100 h-2.5 w-96 rounded-lg">
                    <div
                      class="progression2 text-transparent bg-teal-400 h-2.5 rounded-lg"
                      :style="'width: ' + pourcentage + '%'"
                    ></div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<style></style>
