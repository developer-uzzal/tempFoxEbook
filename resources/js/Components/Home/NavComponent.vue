<script setup>
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();

const search1 = ref('')

const slugify = (text) => {
    return text
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9 -]/g, '') // Remove invalid characters
        .replace(/\s+/g, '-') // Replace spaces with dashes
        .replace(/-+/g, '-') // Remove multiple dashes
}

const submit = () => {
    if (search1.value.trim() === '') {
        new Notify({
            status: 'error',
            title: 'Search Field is required',
            autotimeout: 2000,
        })
        return
    }

    const search = slugify(search1.value)
    

    router.get("/search/"+search)
}
</script>

<template>

<div class="sticky-top bg-white border-bottom shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <Link class="navbar-brand fw-bold" href="/"><img width="100" height="50" :src="page.props.menuFooter.logo? `${'/' + page.props.menuFooter.logo}`  : '/dashboard/assets/img/no-book.jpg'" alt="logo"></Link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-lg-between" id="navbarSupportedContent">
                    <ul class="navbar-nav text-center col-md-5 d-flex justify-content-center">
                        <li class="nav-item">
                            <Link class="nav-link fw-bold" :class="page.component === 'Home/Home' ? 'text-primary' : 'text-dark'" href="/" >Home</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link text-dark fw-bold" href="/about">About</Link>
                        </li>

                        <!-- <li class="nav-item">
                            <Link class="nav-link text-dark fw-bold" href="/authors">Authors</Link>
                        </li> -->

                        <!-- <li class="nav-item">
                            <Link class="nav-link text-dark fw-bold" href="/trending">Trending</Link>
                        </li> -->

                        <!-- <li class="nav-item">
                            <Link class="nav-link text-dark fw-bold" href="/contact">Contact</Link>
                        </li> -->

                        <li class="nav-item dropdown">
                            <Link class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Languages
                            </Link>
                            <ul class="dropdown-menu">
                                <li><Link class="dropdown-item text-dark fw-bold" :href="`/book/language/${language.slug}`" v-for="(language, index) in page.props.languages" :key="index">{{ language.name? language.name : 'Unknown' }}</Link></li>
                                
                            </ul>
                        </li>

                        <li class="nav-item">
                            <Link class="nav-link text-dark fw-bold" href="/donate">Donate <i class="fa-solid fa-heart text-danger"></i></Link>
                        </li>
                    </ul>
                    <div class="col-md-7">
                            <div class="input-group col-md-12 col-sm-12">
                               <input v-model="search1" class="form-control form-control-lg focus-shadow-none focus-shadow-none" type="search"
                                   placeholder="Search Book" aria-label="Search">
                               <button class="btn btn-primary px-4" @click="submit">
                                   <i class="fa-solid fa-magnifying-glass"></i>
                               </button>
                           </div>
                        </div>
                </div>
            </div>
        </nav>
    </div>
</div>




</template>

<style scoped>
.nav-link{
    font-size: 16px !important;

}
.nav-link:hover{
    color: #0D6EFD !important;
}

input:focus,
textarea:focus,
select:focus,
button:focus {
   outline: none !important;
   box-shadow: none !important;
}

@media (max-width: 767px) {
 .mobile-margin-for-button {
   margin-top: 20px !important;
   text-align: center !important;
 }
}
.mobile-margin-for-button {
 text-align: right !important;
}

</style>
