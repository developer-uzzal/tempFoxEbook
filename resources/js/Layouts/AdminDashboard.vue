<template>
     <Head>
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" :href="page.props.user.img">
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
import { usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<style scoped>

</style>
