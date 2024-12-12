@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            {{ __('Task Details') }}
        </h2>
        <a href="{{ route('projects.show', $task->project->id) }}" class="btn btn-warning">{{ __('Back to Project') }}</a>
    </div>
@endsection

@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $task->title }}</h5>
            <p><strong>{{ __('Project:') }}</strong> {{ $task->project->name }}</p>
            <p><strong>{{ __('Priority:') }}</strong>
                <span
                    class="badge
                    @if ($task->priority === 'LOW') bg-secondary
                    @elseif($task->priority === 'MEDIUM') bg-warning
                    @else bg-danger @endif">
                    {{ ucfirst(strtolower($task->priority)) }}
                </span>
            </p>
            <p><strong>{{ __('Status:') }}</strong>
                <span
                    class="badge
                    @if ($task->status === 'TODO') bg-secondary
                    @elseif($task->status === 'INPROGRESS') bg-warning
                    @else bg-success @endif">
                    {{ ucfirst(strtolower($task->status)) }}
                </span>
            </p>
            <p><strong>{{ __('Start Date:') }}</strong> {{ $task->start_date }}</p>
            <p><strong>{{ __('End Date:') }}</strong> {{ $task->end_date ?? 'N/A' }}</p>
            <p><strong>{{ __('Description:') }}</strong> {{ $task->description }}</p>
            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info">{{ __('Edit') }}</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this task?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Assignees -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">{{ __('Assigned Members') }}</h5>
        </div>
        <div class="card-body">
            @if ($task->assignees->isEmpty())
                <p class="text-muted">{{ __('No team members assigned.') }}</p>
            @else
                <ul class="list-group">
                    @foreach ($task->assignees as $member)
                        <li class="list-group-item">{{ $member->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Change Status -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">{{ __('Update Task Status') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="status" class="form-label">{{ __('Task Status') }}</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
                        required>
                        <option value="TODO" {{ $task->status === 'TODO' ? 'selected' : '' }}>{{ __('To Do') }}
                        </option>
                        <option value="INPROGRESS" {{ $task->status === 'INPROGRESS' ? 'selected' : '' }}>
                            {{ __('In Progress') }}</option>
                        <option value="COMPLETED" {{ $task->status === 'COMPLETED' ? 'selected' : '' }}>
                            {{ __('Completed') }}</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{ __('Update Status') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
