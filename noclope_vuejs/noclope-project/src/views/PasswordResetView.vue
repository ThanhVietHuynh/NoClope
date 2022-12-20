<script>
    export default{
        data(){
            return{
                email: ""
            }
        },

        methods: {
            async reset(){
                const body = {
                    email: this.email
                };

                const response = await fetch("http://127.0.0.1:8000/api/forgot-password",
                {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },

                    body: JSON.stringify(body)
                });
                const data = await response.json();
            }
        }
    }
</script>

<template>
    <body class="font-mono bg-gray-400">
		<!-- Container -->
		<div class="container mx-auto">
			<div class="flex justify-center px-6 my-12">
				<!-- Row -->
				<div class="w-full xl:w-3/4 lg:w-11/12 flex">
					<!-- Col -->
					<div
						class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
						style="background-image: url('https://source.unsplash.com/oWTW-jNGl9I/600x800')"
					></div>
					<!-- Col -->
					<div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
						<div class="px-8 mb-4 text-center">
							<h3 class="pt-4 mb-2 text-2xl">Vous avez oublié votre mot de passse ?</h3>
							<p class="mb-4 text-sm text-gray-700">
								Ne vous inquietez pas ! Entrez votre adresse email et vous recevrez par mail un lien permettant de reinitialiser votre mot de passe !
							</p>
						</div>
						<form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" @submit.prevent="reset">
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="email">
									Email :
								</label>
								<input
									class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="email"
									type="email"
									placeholder="Entrez votre adresse email..."
                                    v-model="email"
								/>
							</div>
							<div class="mb-6 text-center">
								<button
									class="w-full px-4 py-2 font-bold text-white bg-red-500 rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline"
									type="submit"
								>
									Reinitialiser votre mot de passe
								</button>
							</div>
							<hr class="mb-6 border-t" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</template>