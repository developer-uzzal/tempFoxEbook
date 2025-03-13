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
                                   data-bs-target="#exampleModal">Create Category</button>

                           </div>
                       </div>

                       <!-- Modal -->
                       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                           aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                               <div class="modal-content">
                                   <form @submit.prevent="CategorySubmit">
                                       <div class="modal-header">
                                           <h1 class="modal-title fs-5 " id="exampleModalLabel">Enter New Category Name
                                           </h1>


                                       </div>
                                       <div class="modal-body">
                                           <input v-model="form.name" type="text" class="form-control w-100"
                                               placeholder="Category Name">
                                            
                                            
                                            <div class="mt-3">
                                                <label for="status" class="form-label mb-0"> Is Active</label>
                                                <input type="checkbox" v-model="form.status" class="form-check mt-0">
                                            </div>
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
                           <!-- <table class="table table-bordered">
                               <thead class="table-dark">
                                   <tr >
                               <th>S.No</th>
                               <th>Category Name</th>
                               <th>Action</th>
                           </tr>
                               </thead>

                               <tbody>

                                   <tr v-for="(category, index) in page.props.list.data">
                               <td>{{ page.props.list.from + index }}</td>
                               <td>{{ category.name }}</td>
                               <td> 
                                   <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                               data-bs-target="#editModal"
                                               @click="categoryEditClick(category.id, category.name)" >Edit</button> 
                                   <button class="btn btn-sm btn-danger me-2" data-bs-toggle="modal"
                                               data-bs-target="#deleteModal"
                                               @click="categoryDeleteClick(category.id)">Delete</button>
                               </td>
                           </tr>

                               </tbody>
                       </table> -->


                       <EasyDataTable buttons-pagination alternating :headers="header" :items="item"
                            theme-color="#009A31" row-per-page="5" table-class-name="customize-table"
                            :search-field="searchField" :search-value="searchValue" show-index>

                            <template #item-is_active="{ is_active }">
                                <span v-if="is_active" class="badge bg-success">Active</span>
                                <span v-else class="badge bg-danger">Inactive</span>
                            </template>

                            <template #item-number="{ id, name, books, is_active }">
                                <div class="d-flex align-items-center my-2">
                                    <Link class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal"
                                        data-bs-target="#editModal" @click="categoryEditClick(id, name, is_active)" href="#"><i
                                        class="fa-regular fa-pen-to-square"></i></Link>
                                    <Link class="btn btn-sm btn-danger" href="#" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" @click="categoryDeleteClick(id, books.length)"><i
                                        class="fa-regular fa-trash-can"></i></Link>
                                </div>
                            </template>


                        </EasyDataTable>


                       </div>
                       

                       <nav aria-label="Page navigation example">
                           
                           <ul class="pagination">
                               <li v-for="(category, index) in page.props.list.links" :key="index" class="page-item" :class="{ active: category.active, disabled: !category.url }">
                                   
                                   <Link class="page-link" :href="category.url?category.url : '#'">
                                       {{  index === 0 ? 'Previous' :  index === page.props.list.links.length - 1 ? 'Next' : category.label }}

                                       <!-- {{ category.label === '&laquo; Previous' ? 'Previous' :  category.label === ' Next &raquo;' ? 'Next' : category.label }} -->
                                   </Link>

                                </li>
                           </ul>
                       </nav>


                       <!-- edit Modal -->
                       <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                           aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                               <div class="modal-content">

                                   <div class="modal-header">
                                       <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category Name</h1>

                                   </div>
                                   <div class="modal-body">
                                       <input v-model="categoryEdit.name" type="text" class="form-control w-100"
                                           placeholder="Category Name">

                                           <div class="mt-3">
                                                <label for="status" class="form-label mb-0"> Is Active</label>
                                                <input type="checkbox" v-model="categoryEdit.status" class="form-check mt-0">
                                            </div>
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
                                       <button type="button" class="btn btn-secondary" :disabled="categoryDelete.processing"
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
    { text: 'Status', value: 'is_active' },
    { text: 'Books', value: 'books.length' },
    { text: 'Action', value: 'number' },
]

const page = usePage();

const searchField = ['name'];
const searchValue = ref('');
const item = ref(page.props.list);




const form = useForm({
   name: '',
   status: false

})

// for create category

const CategorySubmit = () => {



   if (form.name == '') {
       new Notify({
           status: 'error',
           title: 'Category name is required',
           autotimeout: 2000,
       })

   } else {

       form.post('/user-category-create', {
           onSuccess: () => {
               Modal.getInstance('#exampleModal').hide();
               if (page.props.flash.success) {
                   new Notify({
                       status: 'success',
                       title: page.props.flash.success.message,
                       autotimeout: 2000,
                   })

                   form.reset();
                   router.get("/user-category");

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
   name: '',
   status: false
})


const categoryEditClick = (id, name, is_active) => {
   categoryEdit.id = id;
   categoryEdit.name = name;
   if (is_active == 1) {
       categoryEdit.status = true
   }else {
       categoryEdit.status = false
   }
}

const categoryUpdateSubmit = () => {
   if (categoryEdit.name == '') {
       new Notify({
           status: 'error',
           title: 'Category name is required',
           autotimeout: 2000,
       })

   } else {

       categoryEdit.put('/user-category-update', {
           onSuccess: () => {
               Modal.getInstance('#editModal').hide();
               if (page.props.flash.success) {
                   new Notify({
                       status: 'success',
                       title: page.props.flash.success.message,
                       autotimeout: 2000,
                   })

                   categoryEdit.reset();    
                   router.get("/user-category");

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

   const categoryDelete = useForm({
       id: '',
       book: '',
   })
   const categoryDeleteClick = (id, book) => {
        categoryDelete.id = id;
        categoryDelete.book = book;
        
   }

   const deleteConfirm = () => {
       
    if(categoryDelete.book > 0){
        new Notify({
            status: 'error',
            title: 'This category has books',
            autotimeout: 2000,
        })
    }else{
        categoryDelete.delete('/user-category-delete', {
           onSuccess: () => {
               Modal.getInstance('#deleteModal').hide();
               if (page.props.flash.success) {
                   new Notify({
                       status: 'success',
                       title: page.props.flash.success.message,
                       autotimeout: 2000,
                   })
                   router.get("/user-category");
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
