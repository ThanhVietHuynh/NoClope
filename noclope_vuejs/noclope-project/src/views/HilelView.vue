<!-- <script>
export default{
  name:"App",
  
  data(){
    return{
      contacts:[],
    };
  },

  method: {
    async getContacts(){
      const response = await fetch("http://127.0.0.1:8000/api/contact", {
        method:"GET",
        headers:{
          "Accept":"application/json"
        }
      });

      const data = await response.json();
     
      this.contacts = data.contacts;
    },
  },
  monted(){
    this.getContacts();
  }
};
</script>

<template>
  <div>
    <h2>Listes des contacts</h2>
    <ul>
      <li v-for="contact in contacts" :key="contact.id"></li>
      <p>Prénom: {{contact.firstname}}</p>
      <p>Nom: {{contact.lastname}}</p>
      <p>Numéro carte CB: {{contact.number_phone}}</p>
    </ul>
  </div>

  <button @click="getContats">Récupérer les contacts</button>

</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style> -->
