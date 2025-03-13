<template>
    <BookCountryList />
</template>

<script setup>
import AdminDashboard from '../../../Layouts/AdminDashboard.vue';
 defineOptions({
    layout: AdminDashboard
 })

 import BookCountryList from '../../../Components/Admin/BookCountry/BookCountryList.vue';
</script>

<style scoped>

</style>