<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $projects = Project::with(['tasks.assignees'])->get();
        return view('tasks.index', compact('projects'));
    }

    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);
        $teamMembers = User::role('team member')->get();
        return view('tasks.create', compact('project', 'teamMembers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:LOW,MEDIUM,HIGH',
            'status' => 'required|in:TODO,INPROGRESS,COMPLETED',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'assignees' => 'array',
            'assignees.*' => 'exists:users,id',
        ]);

        $task = Task::create($validated);

        if (!empty($validated['assignees'])) {
            $task->assignees()->sync($validated['assignees']);
        }

        return redirect()->route('projects.show', $validated['project_id'])
            ->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $task = Task::with('assignees', 'project')->findOrFail($id);
        $teamMembers = $task->project->teamMembers;
        return view('tasks.edit', compact('task', 'teamMembers'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:LOW,MEDIUM,HIGH',
            'status' => 'required|in:TODO,INPROGRESS,COMPLETED',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'assignees' => 'array',
            'assignees.*' => 'exists:users,id',
        ]);

        $task->update($validated);

        if (!empty($validated['assignees'])) {
            $task->assignees()->sync($validated['assignees']);
        } else {
            $task->assignees()->detach();
        }

        return redirect()->route('projects.show', $task->project_id)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('projects.show', $task->project_id)
            ->with('success', 'Task deleted successfully.');
    }

    public function show($id)
    {
        $task = Task::with(['project', 'assignees'])->findOrFail($id);
        return view('tasks.show', compact('task'));
    }
    public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:TODO,INPROGRESS,COMPLETED',
        ]);
        $task->update(['status' => $validated['status']]);

        return redirect()->route('tasks.show', $task->id)
            ->with('success', 'Task status updated successfully.');
    }

}
