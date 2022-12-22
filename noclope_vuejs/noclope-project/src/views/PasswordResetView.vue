<script>
export default {
	data() {
		return {
			email: ""
		}
	},

	methods: {
		async reset() {
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
	<!-- <body class="font-mono bg-gray-400"> -->
	<section class="flex items-center justify-center flex-wrap p-7 w-screen">
		<!-- Container -->
		<!-- <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm my-8"> -->
		<div class="container mx-auto rounded-lg shadow-lg bg-white ">
			<div class="flex justify-center px-2 my-12 ">
				<!-- Row -->
				<div class="w-full xl:w-3/4 lg:w-11/12 flex">
					<!-- Col -->
					<div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
						<svg
							xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
							stroke="currentColor" class="w-6/12 text-teal-500">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
						</svg>
					</div>
					<!-- Col -->
					<!-- <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
						<div class="px-8 mb-4 text-center">
							<h3 class="pt-4 mb-2 text-2xl">Vous avez oublié votre mot de passse ?</h3>
							<p class="mb-4 text-sm text-gray-700">
								Ne vous inquietez pas ! Entrez votre adresse email et vous recevrez par mail un lien
								permettant de reinitialiser votre mot de passe !
							</p>
						</div>
						<form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" @submit.prevent="reset">
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="email">
									Email :
								</label>
								<input
									class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="email" type="email" placeholder="Entrez votre adresse email..."
									v-model="email" />
							</div>
							<div class="mb-6 text-center">
								<button
									class="w-full px-4 py-2 font-bold text-white bg-red-500 rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline"
									type="submit">
									Reinitialiser votre mot de passe
								</button>
							</div>
							<hr class="mb-6 border-t" />
						</form>
 -->

						<form @submit.prevent="reset">
							<h1 class="text-sky-900 text-xl mb-4 text-center font-semibold">Vous avez oublié votre mot
								de passse ?</h1>

							<div class="grid grid-cols-1 gap-1">
								<div class="form-group mb-6 justify-center">
									<input v-model="email" type="text" class="form-control
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
										focus:text-gray-700 focus:bg-white focus:border-teal-600 focus:outline-none" id="exampleInput123"
										aria-describedby="emailHelp123" name="email" placeholder="Email">
								</div>
								<p class="text-red-500 mt-2 text-m font-semibold text-center mb-3">
									{{ feedbackMessage }}
								</p>
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
									active:bg-teteal00 active:shadow-lg
									transition
									duration-150
									ease-in-out">Reinitialiser votre mot de passe
									</button>
								</div>
						</form>
					</div>





				
			</div>
		</div>
		
	</section>
</template>