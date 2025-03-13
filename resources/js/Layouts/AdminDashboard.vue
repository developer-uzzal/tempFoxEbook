<template>
     <Head>
    <title>Admin</title>
    </Head>

    <NavComponent></NavComponent>
    <SidebarComponent />

    <div class="content-wrapper">

        <slot />

    </div>


</template>

<script setup>

import NavComponent from '../Components/Dashboard/NavComponent.vue';
import SidebarComponent from '../Components/Dashboard/SidebarComponent.vue';
import { Head } from '@inertiajs/vue3';
</script>

<style scoped>

</style>
