<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Project;

use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index()
    {
       // $projects = Project::all();

        //$projects = Project::where('owner_id', \auth()->id())->get();

        $projects = \auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }
    public function show(Project $project)
    {
        if (\auth()->user()->isNot($project->owner)){
          abort(403);
        }
        return view('projects.show', compact('project'));
    }
    public function store()
    {
        $attributes = \request()->validate([
            'title' => 'required',
            'description' => 'required',
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

}
