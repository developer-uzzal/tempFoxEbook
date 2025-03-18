<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import axios from "axios";
const page = usePage();
import { Modal } from 'bootstrap';

// const downloadBook = (file) => {
//     console.log(file);
//     router.get('/download-book/', { file: file }, {
//         preserveScroll: true
//     });
// }


const downloadBook = async (file) => {
    try {
        const bookName = file.replace('/storage/pdf/', '');

        const filePath = file.replace('/storage/', '');
        const response = await axios.get('/download-book', {
            params: { file: filePath },
            responseType: 'blob'
        });

        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', bookName);
        document.body.appendChild(link);
        link.click();
        link.remove();

        downloadSuccess(filePath);

    } catch (error) {
        console.error("Download failed:", error);
    }
};

const downloadSuccess = (name) => {
    router.post('/download-success', { name: name }, {
        preserveScroll: true
    });
}

const form = useForm({
    email : '',
    message : ''
});

const Submit = () => {
    
    if(form.email == '') {
        new Notify({
            status: 'error',
            title: 'Email is required',
            autotimeout: 4000,
        })
    }else if(form.message == '') {
        new Notify({
            status: 'error',
            title: 'Message is required',
            autotimeout: 4000,
        })
    }else{
        Modal.getInstance('#exampleModal').hide();
        form.post('/premium-members', {
            onSuccess: () => {
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 4000,
                    })
                    form.reset();
                }else if(page.props.flash.error){
                    new Notify({
                        status: 'error',
                        title: page.props.flash.error.message,
                        autotimeout: 4000,
                    })
                }
            },

            onError: () => {
                new Notify({
                    status: 'error',
                    title: 'Submission failed! Please try again',
                    autotimeout: 4000,
                })
            }
        })
    }
}

</script>

<template>
    <div class="container my-5">
        <div class="row align-items-center">
            <!-- Book Cover -->
            <div class=" col-12 col-md-5 col-lg-4 col-xl-4 col-xxl-4  book-img text-center">
                <img :src="page.props.book.image" class="book-cover rounded  shadow" alt="Book Cover">
            </div>

            <!-- Book Details -->
            <div class="col-md-7">
                <h2 class="fw-bold text-primary">{{ page.props.book.title }}</h2>
                <h5 class="text-muted">by
                    <Link class="text-primary text-decoration-none" :href="`/author/${page.props.book.book_auth.slug}`">
                    {{ page.props.book.book_auth.name }}</Link>
                </h5>

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
                            <td>{{ page.props.book.size / 1048576 > 1 ? (page.props.book.size / 1048576).toFixed(2) + 'MB' : (page.props.book.size / 1024).toFixed(2) + ' KB' }} </td>
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

                <button v-if="page.props.book.is_premium == 0" @click="downloadBook(page.props.book.file)"
                    class="btn btn-primary mt-3">
                    Download Now <i class="fa-solid fa-cloud-arrow-down"></i> 
                </button>


                <a v-if="page.props.book.is_premium == 1" href="#" class="btn btn-primary mt-3" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                    <i class="bi bi-book"></i> This book is premium <i class="fa-solid fa-box-open"></i>
                </a>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form @submit.prevent="Submit">
                            <div class="modal-header">
                                <h1 class="modal-title fs-3 text-primary text-center fw-bold w-100" id="exampleModalLabel">Request for this book
                                </h1>

                            </div>
                            <div class="modal-body">
                                <label for="exampleFormControlInput1">Email</label>
                                <input v-model="form.email" type="email" class="form-control w-100"
                                    placeholder="Enter Your Valid Email">
                                
                            <label for="exampleFormControlTextarea1" class="form-label mt-1"> Message with details</label>
                            <textarea v-model="form.message" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Your Message with Reason"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-secondary" :disabled="form.processing" >Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
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
    width: 250px;
    /* Adjust as needed */
    height: 350px;
    /* Adjust as needed */
    object-fit: cover;
    /* Ensures consistent cropping */
}

/* Related book images */
.related-book-img {
    width: 100%;
    /* Adjust for smaller related book covers */
    height: 160px;
    object-fit: contain;
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
