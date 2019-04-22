<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/victory/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Sep 2018 12:21:13 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title') | {{ config('app.name') }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/simple-line-icons/css/simple-line-icons.css')}}">
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/flag-icon-css/css/flag-icon.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')}}">
   <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" />

   
   
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/font-awesome/css/font-awesome.min.css')}}" />
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css')}}">
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
   <link rel="stylesheet" href="{{asset('admin_assets/plugins/dropify/dist/css/dropify.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" />
   <link rel="stylesheet" href="{{asset('admin_assets/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css')}}" />
  <link rel="stylesheet" href="{{asset('admin_assets/css/style.css')}}">
  <script src="{{asset('admin_assets/plugins/jquery/dist/jquery.min.js')}}"></script>
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('admin_assets/images/favicon.png')}}" />
  <style>
   .loader {
  width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: #fff;
  z-index: 1000000;
  text-align: center;
}
.dataTables_wrapper .dataTable .btn, .dataTables_wrapper .dataTable .ajax-upload-dragdrop .ajax-file-upload, .ajax-upload-dragdrop .dataTables_wrapper .dataTable .ajax-file-upload, .dataTables_wrapper .dataTable .swal2-modal .swal2-buttonswrapper .swal2-styled, .swal2-modal .swal2-buttonswrapper .dataTables_wrapper .dataTable .swal2-styled, .dataTables_wrapper .dataTable .wizard > .actions a, .wizard > .actions .dataTables_wrapper .dataTable a{
  padding: 5px !important; 
}
</style>
</head>
<body>
  <div  style="display:none;" class="loader">
   <div class="loader-demo-box">
        <div class="circle-loader"></div>
    </div>
  </div>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{route('admin.dashboard')}}"><img src="{{asset('admin_assets/images/logo.png')}}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{route('admin.dashboard')}}"><img src="{{asset('admin_assets/images/logo-mini.png')}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item dropdown d-none d-lg-flex">
            <a class="nav-link dropdown-toggle nav-btn" id="actionDropdown" href="#" data-toggle="dropdown">
              <span class="btn">+ Create new</span>
            </a>
            <div class="dropdown-menu navbar-dropdown dropdown-left" aria-labelledby="actionDropdown">
              <a class="dropdown-item" href="{{route('manager.add_edit_employers')}}">
                <i class="icon-user text-primary"></i>
                Employer Account
              </a>
              <a class="dropdown-item" href="{{route('add_jobseeker')}}">
                <i class="icon-user text-primary"></i>
                Jobseeker Account
              </a>
              @if($role= Auth::user()->user_role!="Moderator")
              <a class="dropdown-item" href="{{route('sub_admin')}}">
                <i class="icon-user text-primary"></i>
                Moderator
              </a>
              @endif
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('manager.add_edit_company')}}">
                <i class="icon-user-following text-warning"></i>
                Company
              </a>
              
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="icon-info mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="icon-speech mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="icon-envelope mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
         
        
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
          <!-- <div id="settings-trigger"><i class="mdi mdi-plus-circle"></i></div> -->
          <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles primary"></div>
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles pink"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>
        </div>
        