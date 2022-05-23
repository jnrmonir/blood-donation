@extends('layouts.app')

@section('title')
Access Denied or Forbidden
@endsection

@section('description')
Access Denied or Forbidden
@endsection

@section('keywords')
Access Denied or Forbidden
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header bg-white shadow-sm">
    <div class="container clearfix">
        <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">Aceess Denied or Forbidden</h1>
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Access Denied or Forbidden</li>
          </ol>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content mt-2">
    <div class="container">
    <div class="mx-auto">


      <div class="error-content text-center">
        <h2 class="headline text-danger display-1"> 403</h2>
        <h3 class="text-danger"><i class="fas fa-skull-crossbones text-danger"></i> Oops! Access Denied / Forbidden.</h3>

        <p class="text-white">

            You don't have permission to access / to the server <a href="{{ route('home') }}">return to Home</a> or try using the search form.
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
