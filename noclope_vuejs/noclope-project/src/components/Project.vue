<script>

export default {
  data() {
    return {
      goal: "",
      price_goal: 500,
      price_pack: 10,
      consumption: 20,
      // number_day: 0,
      result: null,
      token: "",
    };
  },

  
  methods: {
    
    getProjects: function () {
      // const number_day= (this.price_goal*20/(this.price_pack*this.consumption).toFixed(0));
      // console.log(this.number_day);

      const infoproject = {
        goal: this.goal,
        price_goal: this.price_goal,
        price_pack: this.price_pack,
        consumption: this.consumption,
        number_day: (this.price_goal*20/(this.price_pack*this.consumption)).toFixed(0),

      };
      
      // Condition regex string pour goal
      localStorage.setItem("infoproject", JSON.stringify(infoproject));
      // console.log(infoproject);
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
      this.number_day= parsed.number_day;
}else{}
},

}

</script>

<template>
 <section class="flex items-center justify-center flex-wrap" >
  <img src="@/assets/objectif1.png" class="" alt="">
  <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm my-8">
  <form @submit.prevent="getProjects()">
    <h1 class="text-sky-900 text-xl mb-4 text-center font-semibold">Simulons votre projet !</h1>
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
        focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInputEmail2"
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
        focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInputPassword2"
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
        focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInputPassword2"
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
        focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInputPassword2"
        placeholder="Votre consommation">
    </div>
  
    <button v-if="showButton()" @click="$router.push('/register')" type="submit" class="
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
      active:bg-teal-600 active:shadow-lg
      transition
      duration-150
      ease-in-out">Simuler mon projet</button>
    
  </form>
</div>
 </section>

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
