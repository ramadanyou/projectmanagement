<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', function () {
        $totalProjects = Project::count();
        $ongoingProjects = Project::where('status', 'STARTED')->count();
        $completedProjects = Project::where('status', 'COMPLETED')->count();
        $totalTeamMembers = User::role('team member')->count();

        $projects = Project::withCount(['tasks as completed_tasks' => function ($query) {
            $query->where('status', 'COMPLETED');
        }, 'tasks'])->get();

        return view('dashboard', compact('totalProjects', 'ongoingProjects', 'completedProjects', 'totalTeamMembers', 'projects'));
    })->name('dashboard');

    // Profile Routes (Available for all roles)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes (Full Access)
    Route::middleware(['role:administrator,project manager'])->group(function () {
        // Projects
        Route::prefix('projects')->controller(ProjectController::class)->name('projects.')->group(function () {
            // Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            // Route::get('/{project}', 'show')->name('show');
            Route::get('/{project}/edit', 'edit')->name('edit');
            Route::put('/{project}', 'update')->name('update');
            Route::delete('/{project}', 'destroy')->name('destroy');
            Route::put('/{project}/update-status', 'updateStatus')->name('updateStatus');
        });
        Route::prefix('tasks')->controller(TaskController::class)->name('tasks.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create/{project}', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{task}', 'show')->name('show');
            Route::get('/{task}/edit', 'edit')->name('edit');
            Route::put('/{task}', 'update')->name('update');
            Route::delete('/{task}', 'destroy')->name('destroy');
            Route::put('/{task}/update-status', 'updateStatus')->name('updateStatus');
        });
        Route::prefix('users')->controller(UserController::class)->name('users.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{user}/edit', 'edit')->name('edit');
            Route::put('/{user}', 'update')->name('update');
            Route::delete('/{user}', 'destroy')->name('destroy');
        });
    });

    // Route::middleware('role:team member')->group(function () {
        Route::prefix('tasks')->controller(TaskController::class)->name('tasks.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{task}', 'show')->name('show');
            Route::get('/{task}/edit', 'edit')->name('edit');
            Route::put('/{task}', 'update')->name('update');
            Route::put('/{task}/update-status', 'updateStatus')->name('updateStatus');
        });
        Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('projects/', [ProjectController::class, 'index'])->name('projects.index');

});

require __DIR__ . '/auth.php';

