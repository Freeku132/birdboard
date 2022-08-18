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

        $projects = \auth()->user()->allProjects();

        return view('projects.index', compact('projects'));
    }
    public function show(Project $project)
    {
//        if (\auth()->user()->isNot($project->owner)){
//          abort(403);
//        }
        $this->authorize('update', $project);
        $tasks = Task::with('project')->where('project_id', $project->id)->get();
        return view('projects.show', compact('project', 'tasks'));
    }
    public function store()
    {
        $attributes = $this->getValidate();

        //$attributes['owner_id'] = \Auth::id();
        $project =\auth()->user()->projects()->create($attributes);
        //Project::create($attributes);

        return redirect($project->path());
    }
    public function create()
    {
        return view('projects.create');
    }

    public function destroy(Project $project)
    {
        $this->authorize('update', $project);

        $project->delete();
        return redirect('/projects');
    }

    public function update(Project $project)
    {
//        if (auth()->user()->isNot($project->owner))
//        {
//            abort(403);
//        }
        $this->authorize('update', $project);

        $attributes = $this->getValidate();

       $project->update($attributes);
//        $project->update([
//            'title' => \request('title'),
//            'notes' => \request('notes'),
//        ]);
        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * @return array
     */
    public function getValidate(): array
    {
        return \request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'min:3|nullable',
        ]);
    }
}
