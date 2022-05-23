@extends('layouts.app')
@section('title')
    Profile Show
@endsection

@section('description')
   Profile
@endsection

@section('keywords')
   Profile
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header bg-white shadow-sm">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center">
                    <h1 class="text-info text-capitalize" style="font-size: 20px">Profile</h1>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container">

{{--            profile information--}}
            <div class="row">
                <div class="col-8 mx-auto">
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')

                        <x-jet-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))

                        @livewire('profile.update-password-form')


                        <x-jet-section-border />
                    @endif

                    @livewire('update-location')
                </div>
            </div>

        </div>
    </div>
@endsection

