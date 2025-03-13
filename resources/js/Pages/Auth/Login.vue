<script setup>
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const page = usePage();
const form = useForm({
    email: '',
    password: '',
})

const submit = () => {
    form.post('/login', {
        onSuccess: () => {
              
               if (page.props.flash.success) {
                   new Notify({
                       status: 'success',
                       title: page.props.flash.success.message,
                       autotimeout: 2000,
                   })

                   form.reset();

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

</script>

<template>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 mx-auto">
                <div class="card shadow border-2 border-success ">
                    <div class="card-title bg-success ">
                    <h3 class="text-center pt-3 text-white">Login</h3>
                    </div>
                    <div class="card-body pt-0">
                    <form class="p-3" @submit.prevent="submit">
                        <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" v-model="form.email" class="form-control" id="email" placeholder="Email">
                        </div>

                        <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input type="password" v-model="form.password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-success mt-3 d-block mx-auto w-50" >Login</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
