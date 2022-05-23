@extends('layouts.app')

@section('title')
    Page Not Found
@endsection

@section('description')
    page not found
@endsection

@section('keywords')
    page not found
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header bg-white shadow-sm">
    <div class="container clearfix">
        <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">404</h1>
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">404</li>
          </ol>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content mt-2">
    <div class="container">
    <div class="mx-auto">


      <div class="error-content text-center">
        <h2 class="headline text-yellow text-center display-1"> 404</h2>
        <h3 class="text-center"><i class="fas fa-exclamation-triangle text-yellow"></i> Oops! Page not found.</h3>

        <p class="text-white">
          We could not find the page you were looking for.
          Meanwhile, you may <a href="{{ route('home') }}">return to Home</a> or try using the search form.
        </p>

        <form class="search-form">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search">

            <div class="input-group-btn">
              <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
              </button>
            </div>
          </div>
          <!-- /.input-group -->
        </form>
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</div>
</div>
@endsection
