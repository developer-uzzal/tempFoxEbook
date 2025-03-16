<script setup>

</script>

<template>

    <div class="container my-4">

        <div>

            <h2 class="border-bottom border-2 border-primary d-inline pb-2">Latest Books</h2>

            <div class="row my-5">

                <div class="col-md-2 col-6">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body text-center">
                            <img class="book-image rounded" src="/public/Home/book2.jpg" alt="Book Cover">
                            <h6 class="mt-2 text-truncate">Shar Arbaeen</h6>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-6">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body text-center">
                            <img class="book-image rounded" src="/public/Home/book2.jpg" alt="Book Cover">
                            <h6 class="mt-2 text-truncate">Shar Arbaeen</h6>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-2 col-6">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body text-center">
                            <img class="book-image rounded" src="/public/Home/book2.jpg" alt="Book Cover">
                            <h6 class="mt-2 text-truncate">Shar Arbaeen</h6>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-2 col-6">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body text-center">
                            <img class="book-image rounded" src="/public/Home/book2.jpg" alt="Book Cover">
                            <h6 class="mt-2 text-truncate">Shar Arbaeen</h6>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-2 col-6">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body text-center">
                            <img class="book-image rounded" src="/public/Home/book2.jpg" alt="Book Cover">
                            <h6 class="mt-2 text-truncate">Shar Arbaeen</h6>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-2 col-6">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body text-center">
                            <img class="book-image rounded" src="/public/Home/book2.jpg" alt="Book Cover">
                            <h6 class="mt-2 text-truncate">Shar Arbaeen</h6>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="button" class="btn btn-primary mt-3 d-block mx-auto">View All <i class="fa-solid fa-arrow-right"></i></button>
                </div>

            </div>

        </div>
    </div>
</template>

<style scoped>


/* Standardized book image size */
.book-image {
    width: 120px;
    /* Same width for all */
    height: 160px;
    /* Same height for all */
    object-fit: cover;
    /* Ensures images are cropped properly */
}

/* Ensure long titles do not break layout */
.text-truncate {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
</style>
