<script>
    export default{
        data(){
            return{
                userList: {},
                user: {},
                contact: {},
                token: ""
            }
        },

        mounted(){
            this.token = this.$route.params.token
        },

        methods:{
            async addContact(){
                console.log(this.token);
                const body = {
                    user: this.user,
                    userList: this.userList,
                    contact: this.contact,
                    token: this.token
                }
                const response = await fetch(`http://127.0.0.1:8000/api/invitation/${this.token}`,{
                    method: 'PUT',
                    headers: {
                        "Content-Type" : "application/json",
                        "Authorization": `Bearer ${this.token}`,
                    },
                    body: JSON.stringify(body)
                
            })
            const data = await response.json();
            },

            async deleteContact(){
                const body = {
                    user: this.user,
                    userList: this.userList,
                    contact: this.contact,
                    token: this.token
                }
                const response = await fetch(`http://127.0.0.1:8000/api/delete/${this.token}`,{
                    method: 'DELETE',
                    headers: {
                        "Content-Type" : "application/json",
                        "Authorization": `Bearer ${this.token}`,
                    },
                    body: JSON.stringify(body)
                
            })
            const data = await response.json();
            }
        }
    }
</script>

<template>
    <p>
        Souhaitez-vous aider votre ami(e) à arreter de fumer ? 
    </p>
<form action="" @submit.prevent="">
    <button @click="addContact" type="submit">Oui, je veux aider mon ami(e) à arreter de fumer !</button>
    <button @click="deleteContact" type="submit">Non, je ne désire pas le soutenir.</button>


</form>
</template>

<style scoped>
    button{
        display: flex;
        border: 2px solid black;
    }
</style>