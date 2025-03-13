<template>
    <HomeComponent></HomeComponent>
</template>

<script setup>
import AdminDashboard from '../../../Layouts/AdminDashboard.vue';
 defineOptions({
    layout: AdminDashboard
 })

import HomeComponent from '../../../Components/Admin/Home/HomeComponent.vue';
</script>

<style scoped>

</style>
