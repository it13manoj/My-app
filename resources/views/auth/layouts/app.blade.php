<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-----------------------admin theme assets-------------------------->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/simple-line-icons/css/simple-line-icons.css')}}">
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/flag-icon-css/css/flag-icon.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('admin_assets/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('admin_assets/plugins/images/favicon.png')}}" />


    <!-----------------------admin theme assets-------------------------->
</head>
<body>
   <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-full-bg">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
            @yield('content')
       </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
    <!-----------------------admin theme assets-------------------------->
     <script src="{{asset('admin_assets/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/popper.js/dist/umd/popper.min.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin_assets/plugins/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{asset('admin_assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('admin_assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('admin_assets/js/misc.js')}}"></script>
  <script src="{{asset('admin_assets/js/settings.js')}}"></script>
  <script src="{{asset('admin_assets/js/todolist.js')}}"></script>
  <!-----------------------admin theme assets-------------------------->
</body>
</html>
