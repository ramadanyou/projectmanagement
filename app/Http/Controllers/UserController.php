<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('project manager')) {
            $users = User::role('team member')->get();
        } else if ($user->hasRole('administrator')) {
            $users = User::role(['project manager', 'team member'])->get();
        } else {
            return redirect()->route('dashboard')
                ->with('error', 'You do not have permission to view this page.');
        }

        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->hasRole(['administrator', 'project manager'])) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to create users.');
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:project manager,team member',
        ]);
        $role = $validated['role'];
        $currentUser = auth()->user();

        if ($currentUser->hasRole('project manager') && $role !== 'team member') {
            return redirect()->route('users.create')->with('error', 'Project managers can only create team members.');
        }

        if ($currentUser->hasRole('team member')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to create users.');
        }
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
        $user->assignRole($role);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->hasRole('project manager') && !$user->hasRole('team member')) {
            return redirect()->route('users.index')->with('error', 'You can only edit team members.');
        }

        if (auth()->user()->hasRole('team member')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to edit users.');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->hasRole('project manager') && !$user->hasRole('team member')) {
            return redirect()->route('users.index')->with('error', 'You can only update team members.');
        }

        if (auth()->user()->hasRole('team member')) {
            return redirect()->route('users.index')->with('error', 'You do not have permission to update users.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:project manager,team member',
        ]);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);
        $user->syncRoles($validated['role']);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (auth()->id() == $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

}
