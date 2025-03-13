<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

  <script src="https://kit.fontawesome.com/80f99d64b1.js" crossorigin="anonymous"></script>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('/dashboard/assets/css/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/dashboard/assets/css/adminlte.min2167.css?v=3.2.0')}}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />

  <style>
    #nprogress {

pointer-events: none;

}



#nprogress .bar {

background: #0D6EFD !important;

height: 3px !important;

z-index: 999999 !important;

}



#nprogress .peg {

box-shadow: 0 0 10px #0D6EFD, 0 0 5px #0D6EFD, !important;

}



#nprogress .spinner {

display: block !important;

}
  </style>
    @vite('resources/js/app.js')
    @inertiaHead
  </head>
  <body>
    @inertia

    <!-- jQuery -->
<script src="{{asset('/dashboard/assets/js/jquery.min.js')}}"></script>
 <!-- Bootstrap 4 -->
 <script src="{{asset('/dashboard/assets/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/dashboard/assets/js/adminlte.min2167.js?v=3.2.0')}}"></script>





  </body>
</html>
