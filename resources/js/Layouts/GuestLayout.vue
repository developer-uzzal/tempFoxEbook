<script setup>
import NavComponent from '../Components/Home/NavComponent.vue';
import FooterComponent from '../Components/Footer/FooterComponent.vue';
import { Head } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>
    <Head>
    <title>{{ page.props.menuFooter.title }}</title>
    <link rel="icon" type="image/x-icon" :href="`${'/' + page.props.menuFooter.fav_icon}`">
    </Head>

    <NavComponent></NavComponent>
    <slot />
    <FooterComponent></FooterComponent>


</template>

<style scoped>

</style>
