<template>
    <div class="container-fluid pt-4 px-4">
        <div class="row d-block">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0 text-center">About Page Details</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit">

                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <div class="col-md-12 mb-3 d-flex">
                                        <div class="col-md-12"><img
                                                :src="form.previewImage ? form.previewImage : form.oldImage"
                                                class="form-control form-control-sm" style="width:100%; height: 200px"
                                                alt=""></div>
                                    </div>

                                    <div class="">
                                        <label for="image" class="form-label">Image (1920 X 1080)</label>
                                        <input type="file" class="form-control" id="image"
                                            @change="uploadImage($event)">

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
    image: '',
    oldImage: page.props.list.img,
    previewImage: '',


})

const uploadImage = (event) => {
    form.image = event.target.files[0];
    form.previewImage = URL.createObjectURL(event.target.files[0]);
}


const submit = () => {


    if (form.previewImage == '' && form.oldImage == '') {

            new Notify({
                status: 'error',
                title: 'image4 is required',
                autotimeout: 2000,
            })

    }else{
        form.post('/user-slider-create', {
            onSuccess: () => {
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    router.get('/user-slider')
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
