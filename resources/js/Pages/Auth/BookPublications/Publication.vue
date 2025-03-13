<template>
    
    <BookPublication></BookPublication>

    
</template>

<script setup>
import AdminDashboard from '../../../Layouts/AdminDashboard.vue';
 defineOptions({
    layout: AdminDashboard
 })

 import BookPublication from '../../../Components/Admin/BookPublications/Publication.vue';
</script>

<style scoped>

</style>