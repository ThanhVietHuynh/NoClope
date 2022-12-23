<script setup>
import { ref } from "vue";
const showCreateContact = ref(true);
// const showButtonCreateContact = ref(true);
</script>
<script>
export default {
  data() {
    return {
      contacts: [],
      firstname: "",
      lastname: "",
      email: "",
      feedbackMessage: "",
    };
  },

  methods: {
    async getContacts() {
      let tokens = localStorage.getItem("token");
      const response = await fetch("http://127.0.0.1:8000/api/contact", {
        method: "GET",
        headers: {
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
      });

      const data = await response.json();

      this.contacts = data.contacts;
           
      console.log(this.contacts.length)
      this.showButtonCreateContact();
    },

    async createContact() {
      const body = {
        email: this.email,
        firstname: this.firstname,
        lastname: this.lastname,
      };
      let tokens = localStorage.getItem("token");
      const response = await fetch("http://127.0.0.1:8000/api/contact", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
        body: JSON.stringify(body),
      });

      const data = await response.json();

      this.feedbackMessage = data.message;
      this.getContacts();
    },

    showContact: function () {
      if (this.contacts == null || this.contacts == 0 || this.contacts == "") {
        return false;
      } else {
        return true;
      }
    },

    showButtonCreateContact: function(){
      if (this.contacts.length < 3) {

        return true;
      } else {
        return false;
      }
      // return false;
    }
  },
  mounted() {
    this.getContacts();
   
    
  },
};
</script>

<template>

  <section class="flex items-center justify-center mb-10 mt-10">
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
      <h2 class="text-sky-900 text-xl mb-4 text-center font-semibold">
        Mes contacts
      </h2>
      <div class="flex justify-around mb-2">
        <button  @click="showCreateContact = !showCreateContact" v-if="showButtonCreateContact()" 
          class="px-6 py-2.5 bg-teal-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-teal-400 hover:shadow-lg focus:bg-teal-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-teal-400 active:shadow-lg transition duration-150 ease-in-out"
        >
          Créer <br />
          un contact
        </button>
        <button
          class="px-6 py-2.5 w-fit bg-teal-500  text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-teal-400 hover:shadow-lg focus:bg-teal-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-teal-400 active:shadow-lg transition duration-150 ease-in-out"
        >
          Modifier <br> un contact
        </button>
      </div>
      <div
        class="block mb-2 p-6 rounded-lg shadow-lg bg-white max-w-md"
        v-if="showContact()"
        v-for="contact in contacts"
        :key="contacts.user_id"
      >
        <p class="text-sky-900 text-l font-semibold">
          {{ contact.firstname }} {{ contact.lastname }}
        </p>
        <p class="text-sky-900 text-l font-semibold">{{ contact.email }}</p>
      </div>
    </div>
  </section>

  <section class="flex items-center justify-center mb-10" :class="{ hidden: showCreateContact }">
    <div v-if="showButtonCreateContact()"
      class="flex flex-col p-6 rounded-lg shadow-lg bg-white max-w-sm w-3/4 teal"
    >
      <form @submit.prevent="createContact" >
        <h2 class="text-sky-900 text-xl mb-4 text-center font-semibold">
          Ajouter un contact
        </h2>
        <div class="form-group mb-6">
          <label
            for="exampleInputEmail2"
            class="form-label inline-block mb-2 text-gray-700"
            >Nom</label
          >
          <input
            v-model="lastname"
            type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none"
            id="exampleInputEmail2"
            aria-describedby="emailHelp"
            placeholder="Nom"
          />
        </div>
        <div class="form-group mb-6">
          <label
            for="exampleInputPassword2"
            class="form-label inline-block mb-2 text-gray-700"
            >Prénom</label
          >
          <input
            v-model="firstname"
            type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none"
            id="exampleInputPassword2"
            placeholder="Prénom"
          />
        </div>
        <div class="form-group mb-6">
          <label
            for="exampleInputPassword2"
            class="form-label inline-block mb-2 text-gray-700"
            >Email</label
          >
          <input
            v-model="email"
            type="email"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none"
            id="exampleInputPassword2"
            placeholder="Votre adresse email"
          />
        </div>

        <button
          type="submit"
          class="w-full px-6 py-2.5 bg-teal-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-teal-400 hover:shadow-lg focus:bg-teal-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-teal-400 active:shadow-lg transition duration-150 ease-in-out"
        >
          Valider
        </button>
      </form>
    </div>
  </section>

  <!-- <p>{{ feedbackMessage }}</p> -->
</template>
