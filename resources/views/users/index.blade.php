@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            {{ __('User Management') }}
        </h2>
        @if (auth()->user()->hasRole('administrator'))
            <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('Add New User') }}</a>
        @endif
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->roles->isNotEmpty())
                                    {{ ucfirst($user->roles->pluck('name')->join(', ')) }}
                                @else
                                    <span class="text-muted">{{ __('No Role Assigned') }}</span>
                                @endif
                            </td>
                            <td>
                                <!-- Edit Button -->
                                @if (auth()->user()->hasRole('administrator') ||
                                        (auth()->user()->hasRole('project manager') && $user->hasRole('team member')))
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-sm btn-info">{{ __('Edit') }}</a>
                                @endif

                                <!-- Delete Button -->
                                @if (auth()->user()->hasRole('administrator'))
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">{{ __('No users found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
