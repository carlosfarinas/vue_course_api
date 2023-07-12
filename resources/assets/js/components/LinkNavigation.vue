<script setup>

</script>

<template>
    <router-link to="/teams">Teams</router-link>&nbsp;
    <router-link to="/users" >Users</router-link>
</template>

<style scoped>
a {
    text-decoration: none;
    border: 1px solid #360032;
    background-color: #360032;
    color: white;
    padding: 0.5rem 2rem;
    cursor: pointer;
}

a:hover,
a:active,
a.active{
    background-color: #5c0556;
    border-color: #5c0556;
}

</style>