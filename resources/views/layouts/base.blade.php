<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') | {{ config('app.name') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->

  <link rel="stylesheet" href="{{ asset('frontend') }}/assets/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-4.min.css">
  {{-- <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/select2.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/theme.min.css">
  <!-- summernote -->
  @stack('css')

  <style>
      .active{
          background: #565656!important;
      }
  </style>
  <!-- Google Font: Source Sans Pro -->
  @livewireStyles

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('frontend/assets/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('frontend/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">BloodBank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Storage::url('images/avatars/'.Auth::user()->profile_photo_path) }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ route('admin.all_users') }}" class="nav-link {{ Request::is('admin/all-users') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ route('admin.all_requested_blood') }}" class="nav-link {{ Request::is('admin/all-requested-blood') ? 'active' : '' }}">
              <i class="nav-icon fas fa-hand-holding-medical"></i>
              <p>
                Requested Blood
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ route('admin.all_category') }}" class="nav-link {{ Request::is('admin/all-category') ? 'active' : '' }}">
                <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Category
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ route('admin.all_posts') }}" class="nav-link {{ Request::is('admin/all-posts') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
              <p>
                Posts
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.all_reports') }}" class="nav-link {{ Request::is('admin/all-reports') ? 'active' : '' }}">
                <i class="nav-icon fas fa-edit"></i>
              <p>
                Reports
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ route('admin.all_feedback') }}" class="nav-link {{ Request::is('admin/all-feedbacks') ? 'active' : '' }}">
                <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                Feedback
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.all_comments') }}" class="nav-link {{ Request::is('admin/all-comments') ? 'active' : '' }}">
                <i class="nav-icon fas fa-comment-dots"></i>
              <p>
                Comments
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ route('admin.all_country') }}" class="nav-link {{ Request::is('admin/all-country') ? 'active' : '' }}">
                <i class="nav-icon fas fa-flag"></i>
              <p>
                Country
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ route('admin.all_states') }}" class="nav-link {{ Request::is('admin/all-states') ? 'active' : '' }}">
                <i class="nav-icon fas fa-globe"></i>
              <p>
                States
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ route('admin.all_city') }}" class="nav-link {{ Request::is('admin/all-city') ? 'active' : '' }}">
                <i class="nav-icon fas fa-city"></i>
              <p>
                City
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-center">
    <strong class="">Copyright &copy; {{date('Y')}} <a href="{{ route('home') }}" class="text-red">Blood Bank</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- Bootstrap 4 -->
<script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/sweetalert2.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/toastr.min.js"></script>

<!-- Admin App -->
<script src="{{ asset('frontend') }}/assets/js/theme.min.js"></script>

@stack('js')

@livewireScripts
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.x/dist/alpine.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>


</body>
</html>
