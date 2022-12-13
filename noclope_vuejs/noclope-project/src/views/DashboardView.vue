<script setup>

import { def } from '@vue/shared';
import Register from '../components/Register.vue';
</script>

<script>
export default {
    data() {
        return {

        };
    },
    methods: {

        async getProjects() {
        const response = await fetch("http://127.0.0.1:8000/api/project", {
          method: "GET",
          headers: {
            Accept: "application/json",
          },
        });

        const data = await response.json();

        this.projects = data.projects;
      },

        mounted() {

        },
    }
</script>

<template>

</template>

<style scoped>

</style>