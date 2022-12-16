<script>
export default{
  
  data(){
    return{
      cracking:[],
      number_smoked_cigarette:"",
      date_cracking:"",
      feedbackMessage:""
    };
  },

  methods: {
    // async getCracking(){
    //   const response = await fetch("http://127.0.0.1:8000/api/cracking", {
    //     method:"GET",
    //     headers:{
    //       "Accept":"application/json"
    //     }
    //   });

    //   const data = await response.json();
     
    //   this.cracking = data.cracking;
    // },

    async createCracking(){
      let tokens = localStorage.getItem('token');

        const body = {
            number_smoked_cigarette: this.number_smoked_cigarette,    
            date_cracking: this.date_cracking,

        }
        const response = await fetch("http://127.0.0.1:8000/api/cracking",{
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "Authorization": `Bearer ${tokens}`
            },
            body: JSON.stringify(body)
        });

        const data = await response.json();

        this.feedbackMessage = data.message;
    }
  },
 
};
</script>

<template>
    
  <section class="flex align-center justify-center">

    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4 my-8">
      <form @submit.prevent="createCracking">
    <h2>Vous avez craqué ?</h2>
    <div class="form-group mb-6">
      <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">Combien de cigarettes ?</label>
      <input v-model="number_smoked_cigarette" type="number" class="form-control
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail2"
        aria-describedby="emailHelp" min="1" placeholder="Nombre de cigarettes fumées">
      </div>
      <div class="form-group mb-6">
      <label for="exampleInputPassword2" class="form-label inline-block mb-2 text-gray-700">Quand est-ce arrivé ?</label>
      <input v-model="date_cracking" type="date" class="form-control block
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword2"
        placeholder="Son prix">
      </div>
      <button type="submit" class="
      w-full
      px-6
      py-2.5
      bg-blue-600
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-blue-700 hover:shadow-lg
      focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
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