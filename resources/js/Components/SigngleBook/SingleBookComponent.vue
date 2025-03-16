<script setup>
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const page = usePage();
</script>



<template>
    <div class="container my-5">
    <div class="row">
        <!-- Book Cover -->
        <div class="col-md-4 book-img text-center">
            <img :src="page.props.book.image" class="book-cover rounded shadow-sm  shadow" alt="Book Cover">
        </div>

        <!-- Book Details -->
        <div class="col-md-8">
            <h1 class="fw-bold">{{ page.props.book.title }}</h1>
            <h5 class="text-muted">by {{ page.props.book.book_auth.name }}</h5>

            <!-- Book Description in Table -->
            <table class="table table-bordered mt-3">
                <tbody>
                    <tr v-if="page.props.book.isbn">
                        <th class="fixed-width">ISBN</th>
                        <td>{{ page.props.book.isbn }}</td>
                    </tr>
                    <tr v-if="page.props.book.pageNumber">
                        <th class="fixed-width">Pages</th>
                        <td>{{ page.props.book.pageNumber }}</td>
                    </tr>
                    <tr v-if="page.props.book.size">
                        <th class="fixed-width">Size</th>
                        <td>{{ page.props.book.size /1048576 > 1 ? (page.props.book.size / 1048576).toFixed(2) + ' MB' : (page.props.book.size / 1024).toFixed(2) + ' KB' }} </td>
                    </tr>
                    <tr v-if="page.props.book.book_language">
                        <th class="fixed-width">Language</th>
                        <td>{{ page.props.book.book_language.name }}</td>
                    </tr>
                    <tr v-if="page.props.book.publication">
                        <th class="fixed-width">Publication</th>
                        <td>{{ page.props.book.publication.name }}</td>
                    </tr>
                    <tr v-if="page.props.book.country">
                        <th class="fixed-width">Country</th>
                        <td>{{ page.props.book.country.name }}</td>
                    </tr>
                    <tr v-if="page.props.book.publish_year">
                        <th class="fixed-width">Published Year</th>
                        <td>{{ page.props.book.publish_year }}</td>
                    </tr>
                    <tr v-if="page.props.book.description">
                        <th class="fixed-width">Description</th>
                        <td class="description-text">
                            {{ page.props.book.description }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <a href="#" class="btn btn-primary mt-3">
                <i class="bi bi-book"></i> Read Now
            </a>
        </div>
    </div>

    <!-- Related Books -->
    <div class="mt-5">
        <h3>Related Books</h3>
        <div class="row">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2" v-for="book in page.props.relatedBooks" :key="book.id">
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

.book-cover {
    width: 250px; /* Adjust as needed */
    height: 350px; /* Adjust as needed */
    object-fit: cover; /* Ensures consistent cropping */
}

/* Related book images */
.related-book-img {
    width: 80%; /* Adjust for smaller related book covers */
    height: 160px;
    object-fit: cover;
}

/* Fix table column width */
.fixed-width {
    width: 150px;
    white-space: nowrap;
}

/* Ensure long descriptions wrap properly */
.description-text {
    max-width: 500px;
    word-wrap: break-word;
    white-space: pre-line;
}
</style>
