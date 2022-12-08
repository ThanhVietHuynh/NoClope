<script setup>
import Register from '../components/Register.vue';
</script>

<template>
  <h1>Formulaire d'inscription</h1>
  <form class="formulaire" action="" method="post">
    <p>
      <label for="nom"
        >Nom :
        <input type="text" name="nom" id="nom" />
      </label>
    </p>
    <p>
      <label for="prenom"
        >Prénom :
        <input type="text" name="prenom" id="prenom" />
      </label>
    </p>
    <p>
      <label for="email"
        >Email :
        <input type="email" name="email" id="email" />
      </label>
    </p>
    <p>
      <label for="cardNumber"
        >Numéro de carte bancaire :
        <input type="text" name="cardNumber" id="cardNumber" />
      </label>
    </p>
    <p>
      <label for="expiry"
        >Date d'expiration :
        <input type="date" name="expiry" id="expiry" />
      </label>
    </p>
    <p>
      <label for="password"
        >Mot de passe :
        <input type="password" name="password" id="password" />
      </label>
    </p>
    <p>
      <label for="confirm"
        >Confirmer votre mot de passe :
        <input type="password" name="confirm" id="confirm" />
      </label>
    </p>
  </form>
</template>

<style>
h1 {
  text-align: center;
}
.formulaire input {
  margin: 20px;
}

form {
  border: 2px solid black;
  text-align: center;
}
</style>
