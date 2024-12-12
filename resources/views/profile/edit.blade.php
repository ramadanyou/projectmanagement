@extends('layouts.app')

@section('header')
    <h2 class="h4 text-dark">
        {{ __('Profile') }}
    </h2>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row g-4">
            <!-- Update Profile Information -->
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
