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
        $this->authorize('update', $project); //Policies ProjectPolicy klasa
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
        $this->authorize('update', $task->project); //Policies
        \request()->validate([
            'body' => 'required',
        ]);

       $table = \request(['completed']);

        if ($task->body == request('body'))
        {
            isset($table['completed']) ? $task->complete() : $task->incomplete();
        }
        else {
            $task->update([
                'body' => \request('body'),
            ]);
            $task->updated_task();
        }


//        $task->update(['completed' => NULL]
//        if (\request()->has('completed'))
//        {
//            $task->complete();
//        }

        return redirect($project->path());
    }

}
