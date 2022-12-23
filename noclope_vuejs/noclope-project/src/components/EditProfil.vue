<script setup>
import { ref } from "vue";
const showUpdateProfile = ref(true);
</script>

<script>
export default {
  data() {
    return {
      profil: [],
      lastname: "",
      firstname: "",
      email: "",
      password: "",
      feedbackMessage: "",
    };
  },

  methods: {
    async getProfil() {
      let tokens = localStorage.getItem("token");
      const response = await fetch(`http://127.0.0.1:8000/api/profil`, {
        method: "GET",
        headers: {
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
      });

      const data = await response.json();

      this.profil = data.profil;
    },

    async updateProfil() {
      const body = {
        lastname: this.lastname,
        firstname: this.firstname,
        email: this.email,
        password: this.password,
      };
      let tokens = localStorage.getItem("token");
      const response = await fetch(`http://127.0.0.1:8000/api/profil`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
        body: JSON.stringify(body),
      });

      const data = await response.json();

      this.feedbackMessage = data.message;
      this.getProfil();
    },
  },
  mounted() {
    this.getProfil();
  },
};
</script>

<template>
  <section class="flex items-center justify-center mb-10">
    <div class="flex flex-col p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
      <div class="flex flex-col justify-center mb-5">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          fill="currentColor"
          class="w-9 h-9 text-teal-500 self-center"
        >
          <path
            fill-rule="evenodd"
            d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
            clip-rule="evenodd"
          />
        </svg>

        <p class="text-sky-900 text-2xl font-semibold self-center">
          Bonjour, {{ profil.firstname }}
        </p>
      </div>

      <div>
        <h3 class="text-sky-900 text-l font-semibold mb-1">Mes infos</h3>
        <p class="text-sky-900 text-m">
          {{ profil.lastname }} {{ profil.firstname }}
        </p>
        <p class="text-sky-900 text-m">{{ profil.email }}</p>
      </div>
      <button
        type="submit"
        @click="showUpdateProfile = !showUpdateProfile"
        class="w-full mt-4 px-6 py-2.5 bg-teal-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-teal-400 hover:shadow-lg focus:bg-teal-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-teal-600 active:shadow-lg transition duration-150 ease-in-out"
      >Modifier mon profil</button>
    </div>
  </section>

  <section
    class="flex items-center justify-center mb-10"
    :class="{ hidden: showUpdateProfile }"
  >
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
      <form @submit.prevent="updateProfil">
        <div class="form-group mb-6">
          <h2 class="text-sky-900 text-l font-semibold mb-1">Modifier le profil</h2>
          <input
            v-model="lastname"
            type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="exampleInputPassword2"
            placeholder="Nouveau Nom"
          />
        </div>
        <div class="form-group mb-6">
          <input
            v-model="firstname"
            type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="exampleInputPassword2"
            placeholder="Nouveau Prénom"
          />
        </div>
        <div class="form-group mb-6">
          <input
            v-model="email"
            type="email"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="exampleInputPassword2"
            aria-describedby="emailHelp"
            placeholder="Nouvel email"
          />
        </div>
        <div class="form-group mb-6">
          <input
            v-model="password"
            type="password"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="exampleInputEmail2"
            placeholder="Nouveau mot de passe"
          />
        </div>
        <p class="text-center text-red-600">{{feedbackMessage}}</p>
        <button
          type="submit"
          class="w-full px-6 py-2.5 bg-teal-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-teal-400 hover:shadow-lg focus:bg-teal-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-teal-600 active:shadow-lg transition duration-150 ease-in-out"
        >
          Valider
        </button>
      </form>
    </div>
  </section>
</template>
