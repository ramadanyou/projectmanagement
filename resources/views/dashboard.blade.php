@extends('layouts.app')

@section('header')
    <h2 class="h4 text-dark">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Projects</h5>
                    <p class="display-4 fw-bold">{{ $totalProjects }}</p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Ongoing Projects</h5>
                    <p class="display-4 fw-bold">{{ $ongoingProjects }}</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Completed Projects</h5>
                    <p class="display-4 fw-bold">{{ $completedProjects }}</p>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Team Members</h5>
                    <p class="display-4 fw-bold">{{ $totalTeamMembers }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Table -->
    <div class="mt-5 card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Project Statistics</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Project Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Tasks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->start_date }}</td>
                                <td>{{ $project->end_date ?? 'N/A' }}</td>
                                <td class="{{ $project->status === 'COMPLETED' ? 'text-success' : ($project->status === 'STARTED' ? 'text-warning' : 'text-danger') }}">
                                    {{ ucfirst(strtolower($project->status)) }}
                                </td>
                                <td>
                                    {{ $project->completed_tasks }}/{{ $project->tasks_count }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No projects found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
