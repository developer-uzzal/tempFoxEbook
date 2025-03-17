<template>

    <div class="container-fluid pt-4 px-4">
        <div class="row d-block">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0 text-center">Add a New Book</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit">

                            <!-- Title & Publish Year -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" v-model="form.title" id="title"
                                        placeholder="Enter book title">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="publish_year" class="form-label">Publish Year</label>
                                    <input type="text" v-model="form.publish_year" class="form-control"
                                        id="publish_year" placeholder="Enter year">
                                </div>
                            </div>

                            <!-- ISBN & Page Number -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="isbn" class="form-label">ISBN Number</label>
                                    <input type="text" class="form-control" v-model="form.isbn" id="isbn"
                                        placeholder="Enter ISBN number">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="pageNumber" class="form-label">Page Number</label>
                                    <input type="number" class="form-control" v-model="form.pageNumber" id="pageNumber"
                                        placeholder="Enter number of pages">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="country_id" class="form-label">Country</label>
                                    <select class="form-select" v-model="form.country_id" id="country_id">
                                        <option selected disabled value="">Choose...</option>
                                        <option v-for="(country, index) in page.props.countries" :key="index"
                                            :value="country.id">
                                            {{ country.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>



                            <!-- Category, Language, Author -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select" id="category_id" v-model="form.category_id">
                                        <option selected disabled value="">Choose...</option>
                                        <option :value="category.id" v-for="category in page.props.categories"
                                            :key="category.id">{{
                                                category.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="book_language_id" class="form-label">Language</label>
                                    <select class="form-select" id="book_language_id" v-model="form.book_language_id">
                                        <option selected disabled value="">Choose...</option>
                                        <option :value="language.id" v-for="language in page.props.languages"
                                            :key="language.id">{{
                                                language.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="book_auth_id" class="form-label">Author</label>
                                    <select class="form-select" id="book_auth_id" v-model="form.book_auth_id">
                                        <option selected disabled value="">Choose...</option>
                                        <option :value="author.id" v-for="author in page.props.authors"
                                            :key="author.id">{{ author.name
                                            }}</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Publication & Country -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="publication_id" class="form-label">Publication</label>
                                    <select class="form-select" id="publication_id" v-model="form.publication_id">
                                        <option selected disabled value="">Choose...</option>
                                        <option :value="publication.id" v-for="publication in page.props.publications"
                                            :key="publication.id">
                                            {{ publication.name }}</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="">
                                        <label for="image" class="form-label">Book Cover Image (232x320)</label>
                                        <input type="file" class="form-control" id="image"
                                            @change="uploadImage($event)">

                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="">
                                        <label for="image" class="form-label">Pdf file</label>
                                        <input type="file" class="form-control" id="image" @change="uploadPdf($event)">

                                    </div>

                                </div>
                            </div>





                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="4"
                                    placeholder="Enter book description" v-model="form.description"></textarea>
                            </div>



                            <div class="row">
                                <!-- Book Status -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label d-block">Book Status</label>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" id="is_active"
                                            v-model="form.is_active">
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" id="premium"
                                            v-model="form.is_premium">
                                        <label class="form-check-label" for="premium">Premium</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" id="is_trending"
                                            v-model="form.is_trending">
                                        <label class="form-check-label" for="is_trending">Trending</label>
                                    </div>


                                </div>

                                <div class="col-md-4 mb-3">
                                    <img :src="form.previewImage === '' ? '/dashboard/assets/img/no-book.jpg' : form.previewImage"
                                        class="form-control form-control-sm" style="width: 100px; height: 80px" alt="">

                                </div>

                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success " :disabled="form.processing">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

const page = usePage();

const form = useForm({
    title: '',
    isbn: '',
    publish_year: '',
    pageNumber: '',
    country_id: '',
    category_id: '',
    book_language_id: '',
    book_auth_id: '',
    publication_id: '',
    image: '',
    previewImage: '',
    description: '',
    is_active: false,
    is_premium: false,
    is_trending: false,
    pdfFile: ''

})

const uploadImage = (event) => {
    form.image = event.target.files[0];
    form.previewImage = URL.createObjectURL(event.target.files[0]);
}

const uploadPdf = (event) => {
    form.pdfFile = event.target.files[0];
}

const submit = () => {

    if (form.title == '') {
        new Notify({
            status: 'error',
            title: 'Book title is required',
            autotimeout: 2000,
        })

    } else if (form.isbn == '') {
        new Notify({
            status: 'error',
            title: 'ISBN is required',
            autotimeout: 2000,
        })
    } else if (form.publish_year == '') {
        new Notify({
            status: 'error',
            title: 'Publish year is required',
            autotimeout: 2000,
        })
    } else if (form.pageNumber == '') {
        new Notify({
            status: 'error',
            title: 'Page number is required',
            autotimeout: 2000,
        })
    } else if (form.country_id == '') {
        new Notify({
            status: 'error',
            title: 'Country is required',
            autotimeout: 2000,
        })
    } else if (form.category_id == '') {
        new Notify({
            status: 'error',
            title: 'Category is required',
            autotimeout: 2000,
        })
    } else if (form.book_language_id == '') {
        new Notify({
            status: 'error',
            title: 'Language is required',
            autotimeout: 2000,
        })
    } else if (form.book_auth_id == '') {
        new Notify({
            status: 'error',
            title: 'Author is required',
            autotimeout: 2000,
        })
    } else if (form.publication_id == '') {
        new Notify({
            status: 'error',
            title: 'Publication is required',
            autotimeout: 2000,
        })
    } else if (form.image == '') {
        new Notify({
            status: 'error',
            title: 'Image is required',
            autotimeout: 2000,
        })
    } else if (form.description == '') {
        new Notify({
            status: 'error',
            title: 'Description is required',
            autotimeout: 2000,
        })
    } else {
        form.post('/user-books-create', {
            onSuccess: () => {
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    form.reset();
                    router.get('/user-create-books')
                } else if (page.props.flash.error) {
                    new Notify({
                        status: 'error',
                        title: page.props.flash.error.message,
                        autotimeout: 2000,
                    })
                }


            },
            onError: () => {
                new Notify({
                    status: 'error',
                    title: 'Create failed',
                    autotimeout: 2000,
                })
            }
        });
    }




}

</script>

<style scoped></style>