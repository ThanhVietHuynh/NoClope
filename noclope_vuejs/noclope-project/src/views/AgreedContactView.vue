<script>
export default {
  data() {
    return {
      userList: {},
      user: {},
      contact: {},
      token: "",
    };
  },

  mounted() {
    this.token = this.$route.params.token;
  },

  methods: {
    async addContact() {
      console.log(this.token);
      const body = {
        user: this.user,
        userList: this.userList,
        contact: this.contact,
        token: this.token,
      };
      const response = await fetch(
        `http://127.0.0.1:8000/api/invitation/${this.token}`,
        {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${this.token}`,
          },
          body: JSON.stringify(body),
        }
      );
      const data = await response.json();
    },

    async deleteContact() {
      const body = {
        user: this.user,
        userList: this.userList,
        contact: this.contact,
        token: this.token,
      };
      const response = await fetch(
        `http://127.0.0.1:8000/api/delete/${this.token}`,
        {
          method: "DELETE",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${this.token}`,
          },
          body: JSON.stringify(body),
        }
      );
      const data = await response.json();
    },
  },
};
</script>

<template>
    <section class="flex items-center justify-center">
  <div  class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4 my-8">
    <p class="text-sky-900 text-xl mb-4 text-center font-semibold">Souhaitez-vous aider votre ami(e) à arrêter de fumer ?</p>
    <form action="" @submit.prevent="" class="flex justify-around mt-10">
      <button @click="addContact" class="w-40 px-6 py-2.5 bg-teal-500  text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-teal-400 hover:shadow-lg focus:bg-teal-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-teal-400 active:shadow-lg transition duration-150 ease-in-out" type="submit">
        Oui
      </button>
      <button @click="deleteContact" class="w-40 px-6 py-2.5 bg-teal-500  text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-teal-400 hover:shadow-lg focus:bg-teal-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-teal-400 active:shadow-lg transition duration-150 ease-in-out" type="submit">
        Non
      </button>
    </form>
  </div>
  </section>
</template>
