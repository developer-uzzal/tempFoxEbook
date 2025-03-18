<script setup>
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>

    <div class="container my-4">

        <div class="mt-5">
            <h3>Latest Books</h3>
            <div class="row">
                <div class="col-6 col-sm-4 col-md-3 col-lg-2" v-for="book in page.props.latest" :key="book.id">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body text-center">
                            <img class="related-book-img rounded" :src="book.image" alt="Book Cover">
                            <h6 class="mt-2 text-truncate">{{ book.title }}</h6>
                        </div>
                        <div class="card-footer text-center">
                            <Link :href="`/book/${book.slug}`" class="btn btn-sm btn-primary">View</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>
.related-book-img {
    width: 100%;
    /* Adjust for smaller related book covers */
    height: 160px;
    object-fit: contain;
}
</style>
