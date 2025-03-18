<script setup>
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
const page = usePage();
</script>

<template>
    <div class="container mt-3 ">
        <div class="d-flex ">
            <div class="col-lg-3 d-none d-md-none d-lg-block d-xl-block d-xxl-block p-0 m-0">
                <ul class="list-group  rounded-0">
                    <li class="list-group-item active p-2 fs-5 fw-bold" aria-current="true"><i class="fa-solid fa-list me-2 fa-fw fs-5"></i>Categories</li>
                    <li class="list-group-item" v-for="(category, index) in page.props.categories.slice(0, 10)" :key="index"><Link class="fw-bold text-decoration-none" :href="`category/${category.slug}`">{{ category.name? category.name : 'Unknown' }}</Link></li>

                    <!-- Accordion List Item -->
                    <!-- <li class="list-group-item p-0">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="headingOne">
                                    <button class="accordion-button collapsed p-2" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                        aria-controls="collapseOne">
                                        Expandable Item
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                                    <div class="accordion-body p-2">
                                        <a href="#">A second item</a>
                                    </div>
                                </div>

                                <div id="collapseOne" class="accordion-collapse collapse border-top"
                                    aria-labelledby="headingOne">
                                    <div class="accordion-body p-2">
                                        <a href="#">A second item</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> -->
                    <!-- End Accordion List Item -->

                </ul>
            </div>


            <div class="col-md-12 col-lg-9  hero-section p-0 m-0">
                <div style="">
                    <img class="w-100" :src="page.props.banner.img? page.props.banner.img : '/public/Home/banner.jpeg'" alt="">
                </div>
            </div>

        </div>

    </div>
</template>

<style scoped>
.hero-section{
    width: 100%;
    height: 458px;
}

.hero-section img{
        height: 458px;
    }

    @media (max-width: 1000px) {
    .hero-section {
        height: 300px; /* Adjust height for smaller screens */
    }
    .hero-section img{
        height: 300px;
    }
}

@media (max-width: 600px) {
    .hero-section {
        height: 200px; /* Adjust height for smaller screens */
        background-size: cover; /* Use cover to ensure the image fills the screen */
    }
    .hero-section img{
        height: 200px;
    }
}
</style>
