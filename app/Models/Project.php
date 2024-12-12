<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'start_date', 'end_date', 'description', 'status',
    ];

    public function teamMembers()
    {
        return $this->belongsToMany(User::class, 'project_team');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
