@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center">
            <h1 class="display-1 text-danger">403</h1>
            <h2 class="mb-3">{{ __('Unauthorized') }}</h2>
            <p class="text-muted mb-4">{{ __('You do not have permission to access this page.') }}</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">{{ __('Back to Home') }}</a>
        </div>
    </div>
@endsection
