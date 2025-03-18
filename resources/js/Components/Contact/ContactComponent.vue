<template>
  <!-- Contact 6 - Bootstrap Brain Component -->
  <section class="py-3 py-md-5 py-xl-8">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
          <h2 class="mb-4 display-5 text-center fw-bold">{{ page.props.list.title ? page.props.list.title : 'Need Help'
            }}</h2>
          <p class="text-secondary mb-5 text-center lead fs-4">{{ page.props.list.description ?
            page.props.list.description : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.' }}
          </p>
          <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card border border-primary rounded shadow-sm overflow-hidden">
            <div class="card-body p-0">
              <div class="row gy-3 gy-md-4 gy-lg-0 align-items-center">
                <div class="col-md-6">
                  <div class="row align-items-lg-center justify-content-center h-100">
                    <div class="w-100">

                      <iframe class="w-100 pl-5"
                        :src="page.props.list.map ? page.props.list.map : 'https://maps.google.com/maps?q=manikpur%20dhanmondi%20dhaka&t=&z=13&ie=UTF8&iwloc=&output=embed'"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>


                    </div>
                  </div>
                </div>
                <div class=" col-md-6">
                  <div class="row align-items-lg-center h-100">
                    <div class="col-12">
                      <form @submit.prevent="Submit">
                        <div class="row gy-4 gy-xl-3 p-4 p-xl-5">
                          <div class="">
                            <h2 class="h1 mb-3 pb-3 text-dark border-bottom pb-3 border-primary border-2 d-inline">Get
                              in touch</h2>
                            <br>
                            <br>
                            <br>

                            <label for="fullname" class="form-label">Full Name <span
                                class="text-danger">*</span></label>
                            <input type="text" v-model="form.name" class="form-control" id="fullname" name="fullname"
                              >
                          </div>
                          <div class="col-12 col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                  class="bi bi-envelope" viewBox="0 0 16 16">
                                  <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                              </span>
                              <input type="email" v-model="form.email" class="form-control" id="email" name="email"
                                >
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <label for="phone" class="form-label">Whatsapp Number</label>
                            <div class="input-group">
                              <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                  class="bi bi-telephone" viewBox="0 0 16 16">
                                  <path
                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                              </span>
                              <input type="tel" v-model="form.phone" class="form-control" id="phone" name="phone"
                                >
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                            <input type="text" v-model="form.subject" class="form-control" id="subject" name="subject"
                              >
                          </div>
                          <div class="col-12">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" v-model="form.message" id="message" name="message" rows="3"
                            ></textarea>
                          </div>
                          <div class="col-12">
                            <div class="d-grid">
                              <button class="btn btn-primary btn-lg" type="submit" :disabled="form.processing">Send Message</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

const page = usePage()

const form = useForm({
  name: '',
  email: '',
  phone: '',
  subject: '',
  message: ''
})

const Submit = () => {
  if (form.name == '') {
    new Notify({
      status: 'error',
      title: 'Name is required',
      autotimeout: 4000,
    })
  } else if (form.email == '') {
    new Notify({
      status: 'error',
      title: 'Email is required',
      autotimeout: 4000,
    })
  } else if (form.subject == '') {
    new Notify({
      status: 'error',
      title: 'Subject is required',
      autotimeout: 4000,
    })
  } else if (form.message == '') {
    new Notify({
      status: 'error',
      title: 'Message is required',
      autotimeout: 4000,
    })
  } else {
    form.post('/contact/message', {
      onSuccess: () => {
        if (page.props.flash.success) {
          new Notify({
            status: 'success',
            title: page.props.flash.success.message,
            autotimeout: 4000,
          })
          form.reset();
        } else if (page.props.flash.error) {
          new Notify({
            status: 'error',
            title: page.props.flash.error.message,
            autotimeout: 4000,
          })
        }
      }
    })
  }
}

</script>

<style scoped></style>