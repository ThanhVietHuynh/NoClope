<script>
export default{
  
  data(){
    return{
      contacts:[],
      firstname:"",
      lastname:"",
      number_phone:"",
      feedbackMessage:""
    };
  },

  methods: {
    async getContacts(){
      let tokens = localStorage.getItem("token");
      const response = await fetch("http://127.0.0.1:8000/api/contact", {
        method:"GET",
        headers:{
          "Accept":"application/json",
          Authorization: `Bearer ${tokens}`,
        }
      });

      const data = await response.json();
     
      this.contacts = data.contacts;
    },

    async createContact(){
        const body = {
            number_phone: this.number_phone,    
            firstname: this.firstname,
            lastname: this.lastname,
        }
        let tokens = localStorage.getItem("token");
        const response = await fetch("http://127.0.0.1:8000/api/contact",{
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                Authorization: `Bearer ${tokens}`,
            },
            body: JSON.stringify(body)
        });

        const data = await response.json();

        this.feedbackMessage = data.message;
        this.getContacts();
    }
  },
  mounted(){
    this.getContacts();
  }
};
</script>

<template>
    
    <form class="form" @submit.prevent="createContact">
        <h2>Ajouter un contact</h2>
        <p class="pContact" type="Nom:"><input class="inputContact" v-model="lastname" placeholder="Entrer le nom du contact"></p>
        <p class="pContact" type="Prénom:"><input class="inputContact" v-model="firstname"  placeholder="Entrer le prénom du contact"></p>
        <p class="pContact" type="Numéro de téléphone:"><input class="inputContact" v-model="number_phone"  placeholder="Entrer le numéro de téléphone du contact"></p>
        <button class="btn" type="submit">Valider</button>
    </form>

    <p>{{feedbackMessage}}</p>

    <section>
        <div>
          <h2>Listes des contacts</h2>
          <ul>
            <li v-for = "contact in contacts" :key="contacts.user_id">
              <p>Prénom: {{contact.firstname}}</p>
              <p>Nom: {{contact.lastname}}</p>
              <p>Numéro de téléphone: {{contact.number_phone}}</p>
            </li>
          </ul>
        </div>
    </section>
    
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


  body{background:#59ABE3;margin:0}
.form{
    width:340px;
    height:440px;
    background:#e6e6e6;
    border-radius:8px;
    box-shadow:0 0 40px -10px #000;margin:calc(50vh - 220px) auto;
    padding:20px 30px;
    max-width:calc(100vw - 40px);
    box-sizing:border-box;
    font-family:'Montserrat',sans-serif;
    position:relative
}
h2{
    margin:10px 0;
    padding-bottom:10px;
    width:180px;
    color:#78788c;border-bottom:3px solid #78788c
}
.inputContact{
    width:100%;
    padding:10px;
    box-sizing:border-box;background:none;
    outline:none;resize:none;border:0;
    font-family:'Montserrat',sans-serif;
    transition:all .3s;
    border-bottom:2px solid #bebed2
}
.inputContact:focus{
    border-bottom:2px solid #78788c
}
.pContact:before{
    content:attr(type);
    display:block;margin:28px 0 0;
    font-size:14px;
    color:#5a5a5a
}
.btn{
    float:right;padding:8px 12px;
    margin:8px 0 0;font-family:'Montserrat',sans-serif;
    border:2px solid #78788c;background:0;
    color:#5a5a6e;cursor:pointer;
    transition:all .3s
}
.btn:hover{
    background:#78788c;color:#fff
}

section{
    margin: 1em;
}

}
</style>