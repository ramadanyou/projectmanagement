@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            {{ __('Tasks Lists') }}
        </h2>
    </div>
@endsection

@section('content')
    <div class="mt-4">
        @foreach ($projects as $project)
            <!-- Collapsible Project Section -->
            <div class="mb-4 border rounded shadow-sm">
                <!-- Project Header -->
                <div class="bg-primary text-white p-3 cursor-pointer" data-bs-toggle="collapse" data-bs-target="#project-{{ $project->id }}" aria-expanded="true" aria-controls="project-{{ $project->id }}">
                    <h5 class="mb-0">
                        {{ $project->name }}
                    </h5>
                </div>

                <!-- Collapsible Tasks (Visible by Default) -->
                <div class="collapse show" id="project-{{ $project->id }}">
                    <div class="p-3 bg-light">
                        @if ($project->tasks->isEmpty())
                            <p class="text-muted mb-0">{{ __('No tasks available.') }}</p>
                        @else
                            <div class="row g-3">
                                @foreach ($project->tasks as $task)
                                    <!-- Task Card -->
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                   <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                                </h6>
                                                <div>
                                                    <p class="mb-1">
                                                        <strong>{{ __('Assigned to:') }}</strong>
                                                        @if ($task->assignees->isEmpty())
                                                            <span class="text-muted">{{ __('Unassigned') }}</span>
                                                        @else
                                                            {{ $task->assignees->pluck('name')->join(', ') }}
                                                        @endif
                                                    </p>
                                                    <p class="mb-0">
                                                        <strong>{{ __('Status:') }}</strong>
                                                        <span class="badge
                                                            @if ($task->status === 'TODO') bg-secondary
                                                            @elseif ($task->status === 'INPROGRESS') bg-warning
                                                            @else bg-success @endif">
                                                            {{ ucfirst(strtolower($task->status)) }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
