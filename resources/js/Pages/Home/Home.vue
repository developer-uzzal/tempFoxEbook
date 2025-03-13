<script setup>
import guestLayout from '../../Layouts/guestLayout.vue';
defineOptions({
    layout: guestLayout
})

import HeroComponent from '../../Components/Home/HeroComponent.vue';
import TrendingBookComponent from '../../Components/Home/TrendingBookComponent.vue';
import LatestBookComponent from '../../Components/Home/LatestBookComponent.vue';
</script>

<template>

    <HeroComponent></HeroComponent>
    <TrendingBookComponent></TrendingBookComponent>
    <LatestBookComponent></LatestBookComponent>


</template>

<style scoped>

</style>
