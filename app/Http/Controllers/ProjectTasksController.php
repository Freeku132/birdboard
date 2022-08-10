<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
       if (auth()->user()->isNot($project->owner))
        {
            abort(403);
        }
        \request()->validate([
            'body' => 'required'
        ]);
        $project->addTask(\request('body'));

        return redirect($project->path());
    }
    public function update(Project $project, Task $task)
    {
        if (auth()->user()->isNot($project->owner))
        {
            abort(403);
        }
        \request()->validate([
            'body' => 'required',
        ]);

        $task->update([
            'body' => \request('body'),
            'completed' => \request('completed')
        ]);

        return redirect($project->path());
    }

}
