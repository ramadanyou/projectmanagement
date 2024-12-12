@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            {{ __('Create Task') }}
        </h2>
        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-warning">{{ __('Back to Project') }}</a>
    </div>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('Task Title') }}</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Priority -->
                <div class="mb-3">
                    <label for="priority" class="form-label">{{ __('Priority') }}</label>
                    <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror" required>
                        <option value="LOW" {{ old('priority') == 'LOW' ? 'selected' : '' }}>{{ __('Low') }}</option>
                        <option value="MEDIUM" {{ old('priority') == 'MEDIUM' ? 'selected' : '' }}>{{ __('Medium') }}</option>
                        <option value="HIGH" {{ old('priority') == 'HIGH' ? 'selected' : '' }}>{{ __('High') }}</option>
                    </select>
                    @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">{{ __('Status') }}</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="TODO" {{ old('status') == 'TODO' ? 'selected' : '' }}>{{ __('To Do') }}</option>
                        <option value="INPROGRESS" {{ old('status') == 'INPROGRESS' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                        <option value="COMPLETED" {{ old('status') == 'COMPLETED' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Start Date -->
                <div class="mb-3">
                    <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                    <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror"
                           value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="mb-3">
                    <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                    <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror"
                           value="{{ old('end_date') }}">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" id="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Assignees -->
                <div class="mb-3">
                    <label for="assignees" class="form-label">{{ __('Assignees') }}</label>
                    <select name="assignees[]" id="assignees" class="form-select @error('assignees') is-invalid @enderror" multiple>
                        @foreach ($teamMembers as $member)
                            <option value="{{ $member->id }}" {{ collect(old('assignees'))->contains($member->id) ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('assignees')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Hidden Project ID -->
                <input type="hidden" name="project_id" value="{{ $project->id }}">

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{ __('Save Task') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
