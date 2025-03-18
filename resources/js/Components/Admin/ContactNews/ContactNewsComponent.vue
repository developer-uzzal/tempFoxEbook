<template>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex flex-wrap align-items-center  mb-4">
                            <div class="col-md-6 col-sm-12">
                                <h4 class="">Request For Book</h4>
                            </div>

                            <div class="input-group col-md-6 col-sm-12">
                                <input class="form-control form-control-lg focus-shadow-none" type="search"
                                    placeholder="Search" aria-label="Search" v-model="searchValue">
                                <button class="btn btn-success px-4">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>

                            

                        </div>

                        <div>

                            <EasyDataTable buttons-pagination alternating :headers="header" :items="item"
                                theme-color="#009A31" :rows-per-page="5" table-class-name="customize-table"
                                :search-field="searchField" :search-value="searchValue" show-index>

                                <template #item-is_read="{ is_read, id }">
                                    <button v-if="is_read" class="badge bg-success border-0"
                                        @click="update(id)">Read</button>
                                    <button v-else class="badge bg-danger border-0" @click="update(id)">Unread</button>

                                </template>


                            </EasyDataTable>


                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex flex-wrap align-items-center mb-4">

                            <div class="col-md-6 col-sm-12">
                                <h4 class="">All Contact Info</h4>
                            </div>

                            <div class="input-group col-md-6 col-sm-12">
                                <input class="form-control form-control-lg focus-shadow-none" type="search"
                                    placeholder="Search" aria-label="Search" v-model="searchValue2">
                                <button class="btn btn-success px-4">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>

                        </div>

                        <div>

                            <EasyDataTable buttons-pagination alternating :headers="header2" :items="item2"
                                theme-color="#009A31" :rows-per-page="5" table-class-name="customize-table"
                                :search-field="searchField2" :search-value="searchValue2" show-index>

                                <template #item-is_read="{ is_read, id }">
                                    <button v-if="is_read" class="badge bg-success border-0"
                                        @click="update2(id)">Read</button>
                                    <button v-else class="badge bg-danger border-0" @click="update2(id)">Unread</button>

                                </template>


                            </EasyDataTable>


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

const page = usePage();
// data table info

const header = [
    { text: 'Email', value: 'email' },
    { text: 'Message', value: 'info' },
    { text: 'Action', value: 'is_read' },

]


const searchField = ['email'];
const searchValue = ref('');
const item = ref(page.props.bookRequest);



const form = useForm({
    id: ''
})

const update = (id) => {
    form.id = id;
    form.post('/admin/contact-news/update', {
        onSuccess: () => {
            new Notify({
                status: 'success',
                title: page.props.flash.success.message,
                autotimeout: 2000,
            })
            router.get('/new-updates-contact');
        }
        
    })
}



// contact message 

const header2 = [
    { text: 'Name', value: 'name' },
    { text: 'Email', value: 'email' },
    { text: 'Phone', value: 'phone' },
    { text: 'Subject', value: 'subject' },
    { text: 'Message', value: 'message' },
    { text: 'Action', value: 'is_read' },

]



const searchField2 = ['email', 'name', 'subject','phone'];
const searchValue2 = ref('');
const item2 = ref(page.props.contactMessageInfo);



const form2 = useForm({
    id: ''
})

const update2 = (id) => {
    form.id = id;
    
    form.post('/admin/contact-new/update', {
        onSuccess: () => {
            new Notify({
                status: 'success',
                title: page.props.flash.success.message,
                autotimeout: 2000,
            })
            router.get('/new-updates-contact');
        }
        
    })
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
