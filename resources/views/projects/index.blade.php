@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            {{ __('Project Lists') }}
        </h2>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">{{ __('Add New Project') }}</a>
    </div>
@endsection

@section('content')
    <div class="row g-4">
        <!-- Project Cards -->
        @foreach ($projects as $project)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a>
                        </h5>
                        <p class="mb-2"><strong>Start Date:</strong> {{ $project->start_date }}</p>
                        <p class="mb-2"><strong>End Date:</strong> {{ $project->end_date ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>Description:</strong> {{ $project->description }}</p>
                        <p class="mb-2"><strong>Team Members:</strong>
                            @if ($project->teamMembers->count() > 0)
                                {{ $project->teamMembers->pluck('name')->join(', ') }}
                            @else
                                None
                            @endif
                        </p>
                        <p class="mb-2"><strong>Status:</strong>
                            <span
                                class="badge
                                @if ($project->status == 'COMPLETED') bg-success
                                @elseif($project->status == 'STARTED') bg-warning
                                @else bg-danger @endif">
                                {{ ucfirst(strtolower($project->status)) }}
                            </span>
                        </p>
                        <p class="mb-0"><strong>Task Completed:</strong>
                            {{ $project->tasks->where('status', 'COMPLETED')->count() }}/{{ $project->tasks->count() }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
