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
                                <button class="btn btn-success  fs-sm-4" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Create Publication</button>
 
                            </div>
                        </div>
 
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form @submit.prevent="CategorySubmit">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 " id="exampleModalLabel">Enter New Publication Name
                                            </h1>
 
 
                                        </div>
                                        <div class="modal-body">
                                            <input v-model="form.name" type="text" class="form-control w-100"
                                                placeholder="Publication Name">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-secondary"
                                                :disabled="form.processing">Save
                                                changes</button>
                                        </div>
 
                                    </form>
                                </div>
                            </div>
                        </div>
 
                        <div>
                            
                        <EasyDataTable buttons-pagination alternating :headers="header" :items="item"
                            theme-color="#009A31" row-per-page="5" table-class-name="customize-table"
                            :search-field="searchField" :search-value="searchValue" show-index>



                            <template #item-number="{ id, name }">
                                <div class="d-flex align-items-center my-2">
                                    <Link class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal"
                                        data-bs-target="#editModal" @click="categoryEditClick(id, name)" href="#"><i
                                        class="fa-regular fa-pen-to-square"></i></Link>
                                    <Link class="btn btn-sm btn-danger" href="#" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" @click="categoryDeleteClick(id)"><i
                                        class="fa-regular fa-trash-can"></i></Link>
                                </div>
                            </template>


                        </EasyDataTable>

                        </div>
                        
 
                        
 
 
                        <!-- edit Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
 
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Publication Name</h1>
 
                                    </div>
                                    <div class="modal-body">
                                        <input v-model="categoryEdit.name" type="text" class="form-control w-100"
                                            placeholder="Publication Name">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            @click="form.reset()">Close</button>
                                        <button type="button" @click="categoryUpdateSubmit" class="btn btn-secondary"
                                            :disabled="form.processing">Save
                                            changes</button>
                                    </div>
 
 
                                </div>
                            </div>
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
                                        <button type="button" class="btn btn-secondary" :disabled="form.processing"
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
    { text: 'Name', value: 'name' },
    { text: 'Action', value: 'number' },
]

const page = usePage();

const searchField = ['name'];
const searchValue = ref('');
const item = ref(page.props.list.data);


 const form = useForm({
    name: ''
 })
 
 // for create category
 
 const CategorySubmit = () => {
 
 
 
    if (form.name == '') {
        new Notify({
            status: 'error',
            title: 'Publication name is required',
            autotimeout: 2000,
        })
 
    } else {
 
        form.post('/user-publications-create', {
            onSuccess: () => {
                Modal.getInstance('#exampleModal').hide();
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
 
                    form.reset();
                    router.get("/user-publications");
 
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
        },
        );
 
    }
 
 }
 
 //  for edit category
 
 const categoryEdit = useForm({
    id: '',
    name: ''
 })
 
 
 const categoryEditClick = (id, name) => {
    categoryEdit.id = id;
    categoryEdit.name = name;
 }
 
 const categoryUpdateSubmit = () => {
    if (categoryEdit.name == '') {
        new Notify({
            status: 'error',
            title: 'Publication name is required',
            autotimeout: 2000,
        })
 
    } else {
 
        categoryEdit.put('/user-publications-update', {
            onSuccess: () => {
                Modal.getInstance('#editModal').hide();
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
 
                    categoryEdit.reset();    
                    router.get("/user-publications");
 
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
                    title: 'Update failed',
                    autotimeout: 2000,
                })
            }
        },
        );
    }
                        
    }
 
    // for delete category
    const categoryDeleteClick = (id) => {
        categoryEdit.id = id;
    }
 
    const deleteConfirm = () => {
        categoryEdit.delete('/user-publications-delete', {
            onSuccess: () => {
                Modal.getInstance('#deleteModal').hide();
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    router.get("/user-publications");
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
 