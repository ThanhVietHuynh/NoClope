<script>
export default{
  
  data(){
    return{
      contacts:[],
      firstname:"",
      lastname:"",
      number_phone:"",
      feedbackMessage:"",
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
    },

    showContact: function () {
      
      if (this.contacts==null || this.contacts==0|| this.contacts==""){
        return false
      }else{
        return true;
      }
    },
  },
  mounted(){
  this.getContacts();
    
  }
};
</script>

<template>

  <section class="flex items-center justify-center" v-if="showContact()" >
        <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md ">
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
    
    <section class="flex items-center justify-center" >
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4 teal">
  <form @submit.prevent="createContact">
    <h2>Ajouter un contact</h2>
    <div class="form-group mb-6">
      <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">Nom</label>
      <input v-model="lastname" type="text" class="form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInputEmail2"
        aria-describedby="emailHelp" placeholder="Nom">
    </div>
    <div class="form-group mb-6">
      <label for="exampleInputPassword2" class="form-label inline-block mb-2 text-gray-700">Prénom</label>
      <input v-model="firstname" type="text" class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInputPassword2"
        placeholder="Prénom">
    </div>
    <div class="form-group mb-6">
      <label for="exampleInputPassword2" class="form-label inline-block mb-2 text-gray-700">Numéro de téléphone</label>
      <input v-model="number_phone"  type="tel" class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInputPassword2"
        placeholder="Numéro de téléphone">
    </div>
  
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
      ease-in-out">Valider</button>
    
  </form>
</div>
    </section>

    <p>{{feedbackMessage}}</p>

    

    
    
</template>

<style scoped>
header {
  line-height: 1.5;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }


  body{background:#59ABE3;margin:0}

h2{
    margin:10px 0;
    padding-bottom:10px;
    width:180px;
    color:#78788c;border-bottom:3px solid #78788c
}

}
</style>