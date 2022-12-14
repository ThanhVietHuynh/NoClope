<script>


export default {
  data() {
    return {
      goal: "",
      price_goal: "",
      price_pack: "",
      consumption: "",
      result: null,
      token: "",
    };
  },

  
  methods: {
    
    getProjects: function () {
      const infoproject = {
        goal: this.goal,
        price_goal: this.price_goal,
        price_pack: this.price_pack,
        consumption: this.consumption,
      };
      
      // Condition regex string pour goal
      console.log(infoproject);
      localStorage.setItem("infoproject", JSON.stringify(infoproject));
    },
    showButton: function () {
      
      if(this.goal==""|this.goal==null|this.price_goal==""|this.price_goal==null|this.price_pack==""|this.price_pack==null|this.consumption==""|this.consumption==null){
        return false
      }else{
        return true;
      }
    },
    
  },

  mounted(){
    const project = localStorage.getItem("infoproject")
    localStorage.clear()
    if(project){
      const parsed = JSON.parse(project)
      this.goal= parsed.goal;
      this.price_goal= parsed.price_goal;
      this.price_pack= parsed.price_pack;
      this.consumption= parsed.consumption;
}else{}
},

}

</script>

<template>
 
  <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
  <form @submit.prevent="getProjects()">
    <div class="form-group mb-6">
      <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">Quel est votre objectif ?</label>
      <input v-model="goal" type="text" class="form-control
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
        aria-describedby="emailHelp" placeholder="Votre objectif">
    </div>
    <div class="form-group mb-6">
      <label for="exampleInputPassword2" class="form-label inline-block mb-2 text-gray-700">Combien d'argent faut-il pour le réaliser ?</label>
      <input v-model="price_goal" type="number" class="form-control block
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
    <div class="form-group mb-6">
      <label for="exampleInputPassword2" class="form-label inline-block mb-2 text-gray-700">Combien payez vous un paquet de cigarette ?</label>
      <input v-model="price_pack" type="number" class="form-control block
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
        placeholder="Prix d'un paquet de cigarette">
    </div>
    <div class="form-group mb-6">
      <label for="exampleInputPassword2" class="form-label inline-block mb-2 text-gray-700">Combien de cigarette consommez vous par jour ?</label>
      <input v-model="consumption" type="number" class="form-control block
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
        placeholder="Votre consommation">
    </div>
  
    <button v-if="showButton()" @click="$router.push('/register')" type="submit" class="
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
      ease-in-out">Simuler mon projet</button>
    
  </form>
</div>

</template>

<style scoped>

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }
}

</style>
