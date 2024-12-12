@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            {{ __('Edit User') }}
        </h2>
        <a href="{{ route('users.index') }}" class="btn btn-warning">{{ __('Back to List') }}</a>
    </div>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password (Leave blank to keep current)') }}</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label for="role" class="form-label">{{ __('Role') }}</label>
                    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                        @if(auth()->user()->hasRole('administrator'))
                            <option value="project manager" {{ $user->roles->first()->name === 'project manager' ? 'selected' : '' }}>{{ __('Project Manager') }}</option>
                        @endif
                        <option value="team member" {{ $user->roles->first()->name === 'team member' ? 'selected' : '' }}>{{ __('Team Member') }}</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{ __('Update User') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
