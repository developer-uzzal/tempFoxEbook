<template>
    
    <BooksList></BooksList>
</template>

<script setup>
import AdminDashboard from '../../../Layouts/AdminDashboard.vue';
 defineOptions({
    layout: AdminDashboard
 })

 import BooksList from '../../../Components/Admin/Book/BooksList.vue';
 

</script>

<style scoped>

</style>