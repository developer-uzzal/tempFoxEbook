<script setup>
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>
  <!-- Footer -->
  <footer class="pt-3 border-top border-2 border-primary text-center text-lg-start bg-body-tertiary text-muted">

    <!-- Section: Links  -->
    <section class=" ">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold text-primary mt-0">
              <img width="150" height="80" :src="page.props.menuFooter.logo? `${'/' + page.props.menuFooter.logo}`  : '/dashboard/assets/img/no-book.jpg'" alt="logo">
            </h6>
            <p>
              {{ page.props.menuFooter.short_des ? page.props.menuFooter.short_des : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.' }}
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 text-primary">
              Company
            </h6>
            <p>
              <Link href="/" class="text-reset text-decoration-none text-primary">Home</Link>
            </p>
            <p>
              <Link href="/about" class="text-reset text-decoration-none text-primary">About</Link>
            </p>
            <p>
              <a href="https://knowledgedew.com/" target="_blank" class="text-reset text-decoration-none text-primary">KnowledgeDew</a>
            </p>
            <p>
              <a href="https://knowledgedew.com/blog/" target="_blank" class="text-reset text-decoration-none text-primary">Blog</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 text-primary">
              Help
            </h6>
            <p>
              <Link href="/donate" class="text-reset text-decoration-none text-primary">Donate</Link>
            </p>
            <!-- <p>
              <Link href="/authors" class="text-reset text-decoration-none text-primary">Authors</Link>
            </p> -->

            <p>
              <Link href="/contact" class="text-reset text-decoration-none text-primary">Contact</Link>
            </p>
            <p>
              <Link href="#!" class="text-reset text-decoration-none text-primary">Privacy Policy</Link>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 text-primary">Contact</h6>
            <p><i class="fas fa-home me-3 text-primary"></i> {{ page.props.menuFooter.address? page.props.menuFooter.address : 'New York, NY 10012, US' }}</p>
            <p>
              <i class="fas fa-envelope me-3 text-primary"></i>
              {{ page.props.menuFooter.email? page.props.menuFooter.email : '7oDp9@example.com' }}
            </p>
            <p><i class="fas fa-phone me-3 text-primary"></i>{{ page.props.menuFooter.phone? page.props.menuFooter.phone : '+ 01 234 567 88' }}</p>
            <div>
              <Link v-if="page.props.menuFooter.facebook" :href="page.props.menuFooter.facebook? page.props.menuFooter.facebook : '#!'" class="me-4 text-reset">
                <i class="fab fa-facebook-f text-primary"></i>
              </Link>
              <Link v-if="page.props.menuFooter.twitter" :href="page.props.menuFooter.twitter? page.props.menuFooter.twitter : '#!'" class="me-4 text-reset">
                <i class="fab fa-twitter text-info"></i>
              </Link>
              <Link v-if="page.props.menuFooter.youtube" :href="page.props.menuFooter.youtube? page.props.menuFooter.youtube : '#!'" class="me-4 text-reset">
                <i class="fa-brands fa-youtube text-danger"></i>
              </Link>
            </div>
          </div>

          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © {{ page.props.menuFooter.year? page.props.menuFooter.year : '2022' }} Copyright:
      <Link class="text-reset fw-bold text-primary text-decoration-none" href="/">{{ page.props.menuFooter.copy_right? page.props.menuFooter.copy_right : 'FoxProLtd' }}</Link>
      | Developed By <a class="text-reset fw-bold text-primary text-decoration-none" href="https://foxproltd.com" target="_blank">FoxProLtd</a> | All Rights Reserved
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</template>

<style scoped></style>
