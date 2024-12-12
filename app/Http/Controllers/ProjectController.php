<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('teamMembers', 'tasks')->get()->sortByDesc('created_at');
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $teamMembers = User::role('project manager')->get();
        return view('projects.create', compact('teamMembers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'required|string',
            'status' => 'required|in:STARTED,ONHOLD,COMPLETED',
            'team_members' => 'array',
            'team_members.*' => 'exists:users,id',
        ]);

        $project = Project::create($validated);
        if (!empty($validated['team_members'])) {
            $project->teamMembers()->sync($validated['team_members']);
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit($id)
{
    $project = Project::with('teamMembers')->findOrFail($id);
    $teamMembers = User::role('project manager')->get();
    return view('projects.edit', compact('project', 'teamMembers'));
}


    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'status' => 'required|in:STARTED,ONHOLD,COMPLETED',
            'team_members' => 'array',
            'team_members.*' => 'exists:users,id',
        ]);

        $project->update($validated);

        if (!empty($validated['team_members'])) {
            $project->teamMembers()->sync($validated['team_members']);
        } else {
            $project->teamMembers()->detach();
        }

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Project updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $project = Project::with('tasks')->findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:STARTED,ONHOLD,COMPLETED',
        ]);
        if ($validated['status'] === 'COMPLETED') {
            $incompleteTasks = $project->tasks->where('status', '!=', 'COMPLETED')->count();

            if ($incompleteTasks > 0) {
                return redirect()->route('projects.show', $project->id)
                    ->with('error', 'Project cannot be marked as completed until all tasks are completed.');
            }
        }
        $project->update(['status' => $validated['status']]);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Project status updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::with('tasks')->findOrFail($id);
        if ($project->tasks->count() > 0) {
            return redirect()->route('projects.show', $project->id)
                ->with('error', 'Project cannot be deleted because it has associated tasks.');
        }
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

}
