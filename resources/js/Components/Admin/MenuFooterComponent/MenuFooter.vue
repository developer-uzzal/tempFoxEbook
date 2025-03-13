<template>

    <div class="container-fluid pt-4 px-4">
        <div class="row d-block">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0 text-center">Menu and Footer Details</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit">

                            <!-- Title & Publish Year -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" v-model="form.title" class="form-control"
                                        id="title" placeholder="Enter Website Title">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" v-model="form.address" id="address"
                                        placeholder="Enter Address">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="description" class="form-label">Short Description</label>
                                    <input type="text" v-model="form.short_description" class="form-control"
                                        id="description" placeholder="Enter short description">
                                </div>

                                
                            </div>

                            <!-- ISBN & Page Number -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="isbn" class="form-label">Contact Phone Number</label>
                                    <input type="text" class="form-control" v-model="form.phone" id="isbn"
                                        placeholder="Enter contact phone number">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="pageNumber" class="form-label">Email</label>
                                    <input type="email" class="form-control" v-model="form.email" id="pageNumber"
                                        placeholder="Enter contact email">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="pageNumber" class="form-label">Copy Right Year</label>
                                    <input type="text" class="form-control" v-model="form.copy_right_year" id="pageNumber"
                                        placeholder="Enter Copy Right Year">
                                </div>
                            </div>



                            <!-- Category, Language, Author -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="pageNumber" class="form-label">Copy Right</label>
                                    <input type="text" class="form-control" v-model="form.copy_right" id="pageNumber"
                                        placeholder="Enter Copy Right text">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="pageNumber" class="form-label">Facebook Link</label>
                                    <input type="text" class="form-control" v-model="form.facebook" id="pageNumber"
                                        placeholder="Enter Facebook Link">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="pageNumber" class="form-label">Twitter Link</label>
                                    <input type="text" class="form-control" v-model="form.twitter" id="pageNumber"
                                        placeholder="Enter Twitter Link">
                                </div>
                            </div>

                            <!-- Publication & Country -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="pageNumber" class="form-label">Youtube Link</label>
                                    <input type="text" class="form-control" v-model="form.youtube" id="pageNumber"
                                        placeholder="Enter Youtube Link">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="">
                                        <label for="image" class="form-label">Website Logo (100X50)</label>
                                        <input type="file" class="form-control" id="image" @change="uploadImage($event)">

                                    </div>
                                    
                                </div>

                                <div class="col-md-4 mb-3 d-flex">
                                    <div class="col-md-4"><img  :src="form.previewImage ? form.previewImage : page.props.list.logo"
                                        class="form-control form-control-sm" style="width: 100px; height: 80px" alt=""></div>

                                    <div class="col-md-8">
                                        <div>
                                        <label for="image" class="form-label">Favicon</label>
                                        <input type="file" class="form-control" @change="favUploadImage($event)" id="image">
                                    </div>
                                    </div>
                                    
                                      
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
    'logo': '',
    'favicon': '',
    'title': page.props.list.title,
    'short_description': page.props.list.short_des,
    'address': page.props.list.address,
    'email': page.props.list.email,
    'phone': page.props.list.phone,
    'facebook': page.props.list.facebook,
    'twitter': page.props.list.twitter,
    'youtube': page.props.list.youtube,
    'copy_right_year': page.props.list.year,
    'copy_right': page.props.list.copy_right,
    'previewImage': '',
    'oldImage': page.props.list.logo,
    'oldFavicon': page.props.list.fav_icon
    

})

const uploadImage = (event) => {
    form.logo = event.target.files[0];
    form.previewImage = URL.createObjectURL(event.target.files[0]);
}

const favUploadImage = (event) => {
    form.favicon = event.target.files[0];
}
const submit = () => {

    if(form.oldImage == null){
        if(form.logo == ''){
            new Notify({
                status: 'error',
                title: 'Logo is required',
                autotimeout: 2000,
            })
        }
        
    }else if(form.oldFavicon == '' ) {
        new Notify({
            status: 'error',
            title: 'favicon is required',
            autotimeout: 2000,
        })
    }else if(form.address == '') {
        new Notify({
            status: 'error',
            title: 'Address is required',
            autotimeout: 2000,
        })
    }else if(form.title == '') {
        new Notify({
            status: 'error',
            title: 'Address is required',
            autotimeout: 2000,
        })
    }else if(form.short_description == '') {
        new Notify({
            status: 'error',
            title: 'Short description is required',
            autotimeout: 2000,
        })
    }else if(form.email == '') {
        new Notify({
            status: 'error',
            title: 'Email is required',
            autotimeout: 2000,
        })
    }else if(form.copy_right_year == '') {
        new Notify({
            status: 'error',
            title: 'Copyright year is required',
            autotimeout: 2000,
        })
    }else if(form.copy_right == '') {
        new Notify({
            status: 'error',
            title: 'copyright is required',
            autotimeout: 2000,
        })
    }else{
        form.post('/user-menu-footer-create', {
        onSuccess: () => {
            if (page.props.flash.success) {
                new Notify({
                    status: 'success',
                    title: page.props.flash.success.message,
                    autotimeout: 2000,
                })
                router.get('/menu-footer')
            }else if(page.props.flash.error){
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