<template>
    <BookLanguage></BookLanguage>
</template>

<script setup>
import AdminDashboard from '../../../Layouts/AdminDashboard.vue';
 defineOptions({
    layout: AdminDashboard
 })

 import BookLanguage from '../../../Components/Admin/BookLanguage/LanguageList.vue';
</script>

<style scoped>

</style>