<script setup>
import Register from '../components/Register.vue';
</script>

<template>
  <h1>Formulaire d'inscription</h1>
  <form class="formulaire" action="" method="post">
    <p>
      <label for="nom"
        >Nom :
        <input type="text" name="nom" id="nom" placeholder="Nom..." />
      </label>
    </p>
    <p>
      <label for="prenom"
        >Prénom :
        <input type="text" name="prenom" id="prenom" placeholder="Prénom..." />
      </label>
    </p>
    <p>
      <label for="email"
        >Email :
        <input type="email" name="email" id="email" placeholder="Email..." />
      </label>
    </p>
    <p>
      <label for="cardNumber"
        >Numéro de carte bancaire :
        <input type="text" name="cardNumber" id="cardNumber" placeholder="Numéro de carte..." />
      </label>
    </p>
    <p>
      <label for="expiry"
        >Date d'expiration :
        <input type="date" name="expiry" id="expiry" placeholder="Date d'expiration..." />
      </label>
    </p>
    <p>
      <label for="password"
        >Mot de passe :
        <input type="password" name="password" id="password" placeholder="Mot de passe..." />
      </label>
    </p>
    <p>
      <label for="confirm"
        >Confirmer votre mot de passe :
        <input type="password" name="confirm" id="confirm" placeholder="Confirmer mot de passe..." />
      </label>
    </p>
    <button type="submit">S'enregistrer</button>
  </form>
</template>

<style scoped>
h1 {
  text-align: center;
  border-bottom: 4px solid gray;
}
.formulaire input {
  margin: 20px;
}

form {
  text-align: center;
  border-radius: 15px;
}

button{
    border: none;
    font-size: large;
    background-color: rgb(88, 87, 87);
    color: white;
    border-radius: 10px;
    padding: 5px;

}

button:hover{
    background-color: gray;
    transition: 200ms;
    cursor: pointer;
}
</style>
