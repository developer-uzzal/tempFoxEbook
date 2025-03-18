<template>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex flex-wrap  mb-4">
                            <div class="input-group col-md-6 col-sm-12">
                                <input class="form-control form-control-lg focus-shadow-none" type="search"
                                    placeholder="Search" aria-label="Search" v-model="searchValue">
                                <button class="btn btn-success px-4">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>

                            <div class="col-md-6 col-sm-12 mobile-margin-for-button ">
                                <Link href="/user-create-books" class="btn btn-success  fs-sm-4" >Create New Book</Link>

                            </div>
                        </div>

                        <div class="table-responsive">
                            <!-- <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr >
                                <th>S.No</th>
                                <th>Publication Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                                </thead>

                                <tbody>

                                    <tr v-for="(book, index) in page.props.list.data">
                                <td>{{ page.props.list.from + index }}</td>
                                <td>{{ book.title }}</td>
                                <td><img style="width: 50px; height: 50px;" :src="book.image ? book.image : '/dashboard/assets/img/no-book.jpg'" alt=""></td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-2"
                                                 @click="bookEditClick(book.id)">Edit</button>
                                    <button class="btn btn-sm btn-danger me-2" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                @click="bookDeleteClick(book.id,book.image)">Delete</button>
                                </td>
                            </tr>

                                </tbody>
                        </table> -->

                        <EasyDataTable buttons-pagination alternating :headers="header" :items="item"
                            theme-color="#009A31" :rows-per-page="10" table-class-name="customize-table"
                            :search-field="searchField" :search-value="searchValue" show-index>

                            <template #item-image="{ image }">
                                <img style="width: 50px; height: 50px;" :src="image ? image : '/dashboard/assets/img/no-book.jpg'"
                                    alt="">
                            </template>

                            <template #item-is_active="{ is_active }">
                                <span v-if="is_active" class="badge bg-success">Active</span>
                                <span v-else class="badge bg-danger">Inactive</span>
                            </template>

                            <template #item-number="{ id, image,file }">
                                <div class="d-flex align-items-center my-2">
                                    
                                    <Link class="btn btn-sm btn-secondary me-2" @click="bookEditClick(id)" href="#"><i
                                        class="fa-regular fa-pen-to-square"></i></Link>
                                    <Link class="btn btn-sm btn-danger" href="#" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" @click="bookDeleteClick(id,image,file)"><i
                                        class="fa-regular fa-trash-can"></i></Link>
                                </div>
                            </template>


                        </EasyDataTable>

                        </div>


                      

                        <!-- delete Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>


                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-secondary" :disabled="bookDelete.processing"
                                            @click="deleteConfirm()">Yes</button>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>


    </div>



 </template>

 <script setup>

 import { useForm } from '@inertiajs/vue3';
 import { usePage } from '@inertiajs/vue3';
 import { Modal } from 'bootstrap';
 import { router } from '@inertiajs/vue3';
 import { Link } from '@inertiajs/vue3';
 import { ref } from 'vue';

// data table info

const header = [
    { text: 'Name', value: 'title' },
    { text: 'Images', value: 'image' },
    { text: 'Download', value: 'download' },
    { text: 'Status', value: 'is_active' },
    { text: 'Action', value: 'number' },
]

const page = usePage();

const searchField = ['title'];
const searchValue = ref('');
const item = ref(page.props.list);


//  for delate book
const bookDelete = useForm({
    id: '',
    image: '',
    pdfFile: ''
 })

 const bookEditClick = (id) => {
    router.get(`/user-books-update/${id}`);
 }


    // for delete book
    const bookDeleteClick = (id, img, file) => {
        bookDelete.id = id;
        bookDelete.image = img;
        bookDelete.pdfFile = file;
    }

    const deleteConfirm = () => {
        bookDelete.delete('/user-books-delete', {
            onSuccess: () => {
                Modal.getInstance('#deleteModal').hide();
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    router.get("/user-books");
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
                    title: 'Delete failed',
                    autotimeout: 2000,
                })
            }
        },
        );



    }

 // for search book

 const searchText = useForm({
    search: ''
 });

 const searchSubmit = () => {
    if(searchText.search == '') {
        new Notify({
            status: 'error',
            title: 'Search field is required',
            autotimeout: 2000,
        })
    }else {
        searchText.get('/user-books');
    }

 }




 </script>

 <style scoped>
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
