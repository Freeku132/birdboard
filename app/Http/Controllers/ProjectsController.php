<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Project;

use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{

    public function index()
    {
       //$projects = Project::with('owner')->get();
        //$projects = Project::where('owner_id', \auth()->id())->get();

        $projects = \auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }
    public function show(Project $project)
    {
//        if (\auth()->user()->isNot($project->owner)){
//          abort(403);
//        }
        $this->authorize('update', $project);
        $tasks = Task::with('project')->get();
        return view('projects.show', compact('project', 'tasks'));
    }
    public function store()
    {
        $attributes = \request()->validate([
            'title' => 'required',
            'description' => 'required|max:100',
            'notes' => 'min:3'
        ]);

        //$attributes['owner_id'] = \Auth::id();
        $project =\auth()->user()->projects()->create($attributes);
        //Project::create($attributes);

        return redirect($project->path());
    }
    public function create()
    {
        return view('projects.create');
    }

    public function update(Project $project)
    {
//        if (auth()->user()->isNot($project->owner))
//        {
//            abort(403);
//        }
        $this->authorize('update', $project);

        \request()->validate([
            'notes' => '',
        ]);

        $project->update(\request(['notes']));
//        $project->update([
//            'notes' => \request('notes'),
//        ]);
        return redirect($project->path());
    }
}
