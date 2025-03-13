<template>
    <div class="container-fluid pt-4 px-4">
        <div class="row d-block">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0 text-center">About Page Details</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit" enctype="multipart/form-data">

                            <!-- Title & Publish Year -->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" v-model="form.title" class="form-control" id="title"
                                        placeholder="Enter Website Title">
                                </div>

                            </div>


                            <!-- Publication & Country -->
                            <div class="row">
                                <div class="col-md-3 mb-3">

                                    <div class="col-md-4 mb-3 d-flex">
                                        <div class="col-md-4"><img
                                                :src="form.previewImage1 ? form.previewImage1 : form.oldImage1"
                                                class="form-control form-control-sm" style="width: 100px; height: 80px"
                                                alt=""></div>
                                    </div>

                                    <div class="">
                                        <label for="image" class="form-label">Image1 (4395X2933)</label>
                                        <input type="file" class="form-control" id="image"
                                            @change="uploadImage1($event)">

                                    </div>

                                </div>

                                <div class="col-md-3 mb-3">

                                    <div class="col-md-4 mb-3 d-flex">
                                        <div class="col-md-4"><img
                                                :src="form.previewImage2 ? form.previewImage2 : form.oldImage2"
                                                class="form-control form-control-sm" style="width: 100px; height: 80px"
                                                alt=""></div>
                                    </div>

                                    <div class="">
                                        <label for="image" class="form-label">Image2 (4395X2933)</label>
                                        <input type="file" class="form-control" id="image"
                                            @change="uploadImage2($event)">

                                    </div>

                                </div>


                                <div class="col-md-3 mb-3">

                                    <div class="col-md-4 mb-3 d-flex">
                                        <div class="col-md-4"><img
                                                :src="form.previewImage3 ? form.previewImage3 : form.oldImage3"
                                                class="form-control form-control-sm" style="width: 100px; height: 80px"
                                                alt=""></div>
                                    </div>

                                    <div class="">
                                        <label for="image" class="form-label">Image3 (4395X2933)</label>
                                        <input type="file" class="form-control" id="image"
                                            @change="uploadImage3($event)">

                                    </div>

                                </div>

                                <div class="col-md-3 mb-3">

                                    <div class="col-md-4 mb-3 d-flex">
                                        <div class="col-md-4"><img
                                                :src="form.previewImage4 ? form.previewImage4 : form.oldImage4"
                                                class="form-control form-control-sm" style="width: 100px; height: 80px"
                                                alt=""></div>
                                    </div>

                                    <div class="">
                                        <label for="image" class="form-label">Image4 (4395X2933)</label>
                                        <input type="file" class="form-control" id="image"
                                            @change="uploadImage4($event)">

                                    </div>

                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Description</label>
                                    <textarea name="description" v-model="form.description" class="form-control" id=""></textarea>
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
    title: page.props.list.title,
    description: page.props.list.long_des,
    image1: '',
    oldImage1: page.props.list.image1,
    previewImage1: '',
    image2: '',
    oldImage2: page.props.list.image2,
    previewImage2: '',
    image3: '',
    oldImage3: page.props.list.image3,
    previewImage3: '',
    image4: '',
    oldImage4: page.props.list.image4,
    previewImage4: '',

})

const uploadImage1 = (event) => {
    form.image1 = event.target.files[0];
    form.previewImage1 = URL.createObjectURL(event.target.files[0]);
}

const uploadImage2 = (event) => {
    form.image2 = event.target.files[0];
    form.previewImage2 = URL.createObjectURL(event.target.files[0]);
}

const uploadImage3 = (event) => {
    form.image3 = event.target.files[0];
    form.previewImage3 = URL.createObjectURL(event.target.files[0]);
}

const uploadImage4 = (event) => {
    form.image4 = event.target.files[0];
    form.previewImage4 = URL.createObjectURL(event.target.files[0]);
}


const submit = () => {
    

    if (form.title == '') {
        new Notify({
            status: 'error',
            title: 'Title is required',
            autotimeout: 2000,
        })
    }else if (form.description == '') {
        new Notify({
            status: 'error',
            title: 'Short description is required',
            autotimeout: 2000,
        })
    }else if (form.previewImage1 == '' && form.oldImage1 == '') {
        
            new Notify({
                status: 'error',
                title: 'image1 is required',
                autotimeout: 2000,
            })
       

    }else if (form.previewImage2 == '' && form.oldImage2 == '') {
        
            new Notify({
                status: 'error',
                title: 'image2 is required',
                autotimeout: 2000,
            })
        
    }else if (form.previewImage3 == '' && form.oldImage3 == '') {
        
            new Notify({
                status: 'error',
                title: 'image3 is required',
                autotimeout: 2000,
            })
       
    }else if (form.previewImage4 == '' && form.oldImage4 == '') {
        
            new Notify({
                status: 'error',
                title: 'image4 is required',
                autotimeout: 2000,
            })
       
    }else{
        form.post('/user-about-create', {
            onSuccess: () => {
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    router.get('/user-about')
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