<template>

    <div class="container-fluid pt-4 px-4">
        <div class="row d-block">
            <div class="col-md-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0"><img class="rounded border border-3 border-white" width="100" height="100" :src="form.oldImage? form.oldImage : form.previewImage? form.previewImage : '/dashboard/assets/img/no-book.jpg'" alt=""></h3>

                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" v-model="form.name" id="name"
                                        placeholder="Enter Your Name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" v-model="form.email" class="form-control"
                                        id="email" placeholder="Enter Your Email">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">Picture</label>
                                    <input type="file" class="form-control" id="image"
                                        @change="uploadImage($event)">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" v-model="form.password" class="form-control"
                                        id="password">
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
    id : page.props.user.id,
    name: page.props.user.name,
    email: page.props.user.email,
    password: '',
    image: '',
    oldImage:page.props.user.img,
    previewImage:''


})

const uploadImage = (event) => {
    form.image = event.target.files[0];
    form.previewImage = URL.createObjectURL(event.target.files[0]);
}

const submit = () => {

    if(form.name == ''){
        new Notify({
            status: 'error',
            title: 'Name is required',
            autotimeout: 2000,
        })

    }else if(form.email == '') {
        new Notify({
            status: 'error',
            title: 'Email is required',
            autotimeout: 2000,
        })
    }else if(form.password == '') {
        new Notify({
            status: 'error',
            title: 'password is required',
            autotimeout: 2000,
        })
    }else{
        form.post('/user-profile-update', {
        onSuccess: () => {
            if (page.props.flash.success) {
                new Notify({
                    status: 'success',
                    title: page.props.flash.success.message,
                    autotimeout: 2000,
                })
                form.reset();
                router.get('/user-profile')
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
