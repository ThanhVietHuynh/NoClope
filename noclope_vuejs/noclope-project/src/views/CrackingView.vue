<script setup>
</script>

<template>
    <h1>Aïe les poumons... </h1>
    <form action="" method="post">
        <p>
            <label for="smoked">Nombre de cigarettes fumées : 
                <input type="number" name="smoked" id="smoked">
            </label>
        </p>
        <p>
            <label for="crackDate">J'ai craqué quand ? 
                <input type="date" name="crackDate" id="crackDate">
            </label>
        </p>
        <p>
            <button type="submit">Je suis un lâche</button>
        </p>
    </form>
</template>

<style scoped>
form input {
  margin: 20px;
}
</style>