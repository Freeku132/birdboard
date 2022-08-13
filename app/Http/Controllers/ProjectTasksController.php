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
//       if (auth()->user()->isNot($project->owner))
//        {
//            abort(403);
//        }
        $this->authorize('update', $project);
        \request()->validate([
            'body' => 'required'
        ]);
        $project->addTask(\request('body'));

        return redirect($project->path());
    }
    public function update(Project $project, Task $task)
    {
//        if (auth()->user()->isNot($task->project->owner))
//        {
//            abort(403);
//        }
        $this->authorize('update', $task->project);
        \request()->validate([
            'body' => 'required',
        ]);


       $table = \request(['completed']);

      isset($table['completed']) ? $table = ['completed' => Carbon::now()] : $table = ['completed' => NULL];

        $task->update([
            'body' => \request('body'),
            'completed' => $table['completed']
        ]);

        return redirect($project->path());
    }

}