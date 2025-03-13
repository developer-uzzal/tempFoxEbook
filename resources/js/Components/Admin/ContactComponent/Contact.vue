<template>
    <div class="container-fluid pt-4 px-4">
        <div class="row d-block">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0 text-center">Contact Page Details</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit">

                            <!-- Title & Publish Year -->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" v-model="form.title" class="form-control" id="title"
                                        placeholder="Enter Website Title">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">Map Link</label>
                                    <input type="text" v-model="form.map" class="form-control" id="title"
                                        placeholder="Enter Map Link">
                                </div>

                            </div>


                            <!-- Publication & Country -->
                            <div class="row">
                               

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
    description: page.props.list.description,
    map: page.props.list.map

})




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
    }else if (form.map == '') {
        
            new Notify({
                status: 'error',
                title: 'map link is required',
                autotimeout: 2000,
            })
       

    }else{
        form.post('/user-contact-create', {
            onSuccess: () => {
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    router.get('/user-contact')
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
        });
    }




}

</script>

<style scoped></style>