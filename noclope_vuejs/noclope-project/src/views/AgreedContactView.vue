<script>
    export default{
        data(){
            return{
                email: "",
                token: null
            }
        }
    }
</script>

<template>
    <p>
        Etes vous d'accord pour rejoindre votre ami(e) dans ce combat ? 
    </p>

    <button type="submit">Oui, je veux aider mon ami(e) à se battre !</button>
    <button type="submit">Non, j'attend qu'il crève...</button>
</template>

<style scoped>
    button{
        display: flex;
        border: 2px solid black;
    }
</style>