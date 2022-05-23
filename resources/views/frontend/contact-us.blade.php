@extends('layouts.app')
@section('title')
    Contact Us
@endsection

@section('description')
Contact us
@endsection

@section('keywords')
Contact us
@endsection


@section('content')

<!-- Content Header (Page header) -->
<div class="content-header bg-white shadow-sm">
    <div class="container clearfix">
        <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">Contact Us</h1>
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Contact Us</li>
          </ol>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

        <!-- Main content -->
    <div class="content mt-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 mx-auto">
                    <div class="card rounded" id="register">
                        <div class="card-body register-card-body">
                            @livewire('contact')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
