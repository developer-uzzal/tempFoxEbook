<template>
     <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="d-flex align-items-center justify-content-between border-bottom border-primary">
      <div  class="brand-link ">
      <img :src="page.props.user.img? page.props.user.img  : '/dashboard/assets/img/no-book.jpg'" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
      </div>

    <!-- Left navbar links -->
    <ul class="navbar-nav d-xl-none d-lg-none d-md-block d-sm-block">
      <li class="nav-item">
        <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fa-solid fa-xmark mr-3"></i></a>
      </li>
    </ul>

    </div>




    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


            <li class="nav-item">
            <Link href="/user-dashboard" class="nav-link" :class="page.url === '/user-dashboard' ? 'active' : ''">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </Link>
          </li>

          <li class="nav-item">
            <Link href="/user-category" class="nav-link " :class="page.component === 'Auth/Category/CategoryList' ? 'active' : ''">
              <i class="nav-icon fa-solid fa-layer-group"></i>
              <p>
                Category
              </p>
            </Link>
          </li>

          <li class="nav-item " :class="page.url === '/user-books' || page.url === '/user-create-books' || page.url === '/user-authors' || page.url === '/user-publications' || page.url === '/user-languages' || page.url === '/user-books-country' ?  'menu-open' : ''">
            <a class="nav-link " href="#">
              <i class="nav-icon fa-solid fa-book"></i>
              <p>
                Books
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <Link href="/user-books" class="nav-link " :class="page.component === 'Auth/Book/BookList' ? 'active' : ''" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Books</p>
                </Link>
              </li>
              <li class="nav-item">
                <Link href="/user-create-books" class="nav-link" :class="page.url === '/user-create-books' ? 'active' : ''">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Book</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link href="/user-authors" class="nav-link" :class="page.component === 'Auth/BookAuthor/BookAuthor' ? 'active' : ''">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Book Authors</p>
                </Link>
              </li>
              <li class="nav-item">
                <Link href="/user-publications" class="nav-link" :class="page.component === 'Auth/BookPublications/Publication' ? 'active' : ''">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Book Publications</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link href="/user-languages" class="nav-link" :class="page.component === 'Auth/BookLanguages/Language' ? 'active' : ''">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Book Languages</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link href="/user-books-country" class="nav-link" :class="page.component === 'Auth/BookCountry/BookCountryList' ? 'active' : ''">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Book Countries</p>
                </Link>
              </li>
            </ul>
          </li>

          <li class="nav-item" :class="page.url === '/user-home' || page.url === '/user-about' || page.url === '/user-contact' ?  'menu-open' : ''">
            <a href="#" class="nav-link">
              <i class=" nav-icon fa-solid fa-list"></i>
              <p>
                Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <Link href="user-slider" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>HomeBanner</p>
                </Link>
              </li>
              <li class="nav-item">
                <Link href="/user-about" class="nav-link" :class="page.url === '/user-about' ? 'active' : ''">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link href="/user-contact" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact</p>
                </Link>
              </li>

            </ul>
          </li>

          <li class="nav-item" :class="page.url === '/menu-footer' ? 'menu-open' : ''">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Website Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Info</p>
                </a>
              </li>
              <li class="nav-item">
                <Link href="/menu-footer" class="nav-link" :class="page.url === '/menu-footer' ? 'active' : ''">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu and Footer</p>
                </Link>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <Link href="/user-profile" class="nav-link" :class="page.url === '/user-profile' ? 'active' : ''">
              <i class="nav-icon fa-regular fa-id-badge"></i>
              <p>
                Profile
              </p>
            </Link>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-regular fa-folder-open"></i>
              <p>
                More ....
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <Link href="/logout" class="nav-link ">
              <i class="nav-icon fa-solid fa-right-from-bracket"></i>
              <p>
                Logout
              </p>
            </Link>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const page = usePage();


</script>

<style scoped>

</style>
