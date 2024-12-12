@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            {{ __('Project Details') }}
        </h2>
        <div class="d-flex gap-2">
            <!-- Edit Button -->
            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-info">{{ __('Edit') }}</a>

            <!-- Delete Button -->
            <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
            </form>
        </div>
    </div>
@endsection

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $project->name }}</h5>
            <p><strong>{{ __('Start Date:') }}</strong> {{ $project->start_date }}</p>
            <p><strong>{{ __('End Date:') }}</strong> {{ $project->end_date ?? 'N/A' }}</p>
            <p><strong>{{ __('Description:') }}</strong> {{ $project->description }}</p>
            <p>
                <strong>{{ __('Status:') }}</strong>
                <span
                    class="badge
                    @if ($project->status === 'STARTED') bg-warning
                    @elseif($project->status === 'ONHOLD') bg-secondary
                    @else bg-success @endif">
                    {{ ucfirst(strtolower($project->status)) }}
                </span>
            </p>
            <form action="{{ route('projects.updateStatus', $project->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PUT')
                <div class="d-flex align-items-center gap-2">
                    <select name="status" id="status"
                        class="form-select form-select-sm w-auto @error('status') is-invalid @enderror">
                        <option value="STARTED" {{ $project->status === 'STARTED' ? 'selected' : '' }}>{{ __('Started') }}
                        </option>
                        <option value="ONHOLD" {{ $project->status === 'ONHOLD' ? 'selected' : '' }}>{{ __('On Hold') }}
                        </option>
                        <option value="COMPLETED" {{ $project->status === 'COMPLETED' ? 'selected' : '' }}>
                            {{ __('Completed') }}</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">{{ __('Update Status') }}</button>
                </div>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </div>

    <!-- Team Members -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">{{ __('Team Members') }}</h5>
        </div>
        <div class="card-body">
            @if ($project->teamMembers->isEmpty())
                <p class="text-muted">{{ __('No team members assigned.') }}</p>
            @else
                <ul class="list-group">
                    @foreach ($project->teamMembers as $member)
                        <li class="list-group-item">{{ $member->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Task List -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('Tasks') }}</h5>
            <a href="{{ route('tasks.create', $project->id) }}" class="btn btn-sm btn-primary">{{ __('Create Task') }}</a>
        </div>
        <div class="card-body">
            @if ($project->tasks->isEmpty())
                <p class="text-muted">{{ __('No tasks found.') }}</p>
            @else
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Assigned Members') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project->tasks as $task)
                            <tr>
                                <td>
                                    <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                </td>
                                <td>
                                    @if ($task->assignees->isEmpty())
                                        <span class="text-muted">{{ __('Unassigned') }}</span>
                                    @else
                                        {{ $task->assignees->pluck('name')->join(', ') }}
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="badge
                                        @if ($task->status === 'TODO') bg-secondary
                                        @elseif($task->status === 'INPROGRESS') bg-warning
                                        @else bg-success @endif">
                                        {{ ucfirst(strtolower($task->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                            class="btn btn-sm btn-info">{{ __('Edit') }}</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
