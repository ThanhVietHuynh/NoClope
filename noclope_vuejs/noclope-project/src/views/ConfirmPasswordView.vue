<script>
    export default{
        data(){
            return{
                email: "",
                password: "",
                password_confirmation: "",
                token: null
            }
        },
        mounted(){
            this.token = this.$route.params.token
        },
        methods:{
            async resetPassword(){
                const body = {
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    token: this.token
                }
                const response = await fetch('http://127.0.0.1:8000/api/reset-password',{
                    method: 'POST',
                    headers: {
                        "Content-Type" : "application/json",
                        "Accept": "application/json",
                    },
                    body: JSON.stringify(body)
                
            })
            const data = await response.json();
            }
        }

        
    }
</script>

<template>
    <div class="w-full max-w-xs">
  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="resetPassword()">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
        Email :
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Votre email" v-model="email">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Nouveau mot de passe
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Nouveau mot de passe" v-model="password">
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
        Confirmer le nouveau mot de passe
      </label>
      <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="confirmpassword" type="password" placeholder="******************" v-model="password_confirmation">
      <p class="text-red-500 text-xs italic">Veuillez confirmer le nouveau mot de passe.</p>
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Confirmer
      </button>
      
    </div>
  </form>

</div>
</template>