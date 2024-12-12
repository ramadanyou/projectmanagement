@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            {{ __('Edit Project') }}
        </h2>
        <a href="{{ route('projects.index') }}" class="btn btn-warning">{{ __('Back to List') }}</a>
    </div>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Project Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Project Name') }}</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $project->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Start Date -->
                <div class="mb-3">
                    <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                    <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror"
                           value="{{ old('start_date', $project->start_date) }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="mb-3">
                    <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                    <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror"
                           value="{{ old('end_date', $project->end_date) }}">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" id="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">{{ __('Status') }}</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="STARTED" {{ old('status', $project->status) == 'STARTED' ? 'selected' : '' }}>{{ __('Started') }}</option>
                        <option value="ONHOLD" {{ old('status', $project->status) == 'ONHOLD' ? 'selected' : '' }}>{{ __('On Hold') }}</option>
                        <option value="COMPLETED" {{ old('status', $project->status) == 'COMPLETED' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Team Members -->
                <div class="mb-3">
                    <label for="team_members" class="form-label">{{ __('Team Members') }}</label>
                    <select name="team_members[]" id="team_members" class="form-select @error('team_members') is-invalid @enderror" multiple>
                        @foreach ($teamMembers as $member)
                            <option value="{{ $member->id }}" {{ collect(old('team_members', $project->teamMembers->pluck('id')))->contains($member->id) ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('team_members')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{ __('Update Project') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
