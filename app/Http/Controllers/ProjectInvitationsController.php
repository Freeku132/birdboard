<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project, ProjectInvitationRequest $request)
    {
        $this->authorize('manage', $project);

//
//        \request()->validate([
//            'email' => 'exists:users,email|required'
//        ],[
//            'email.exists' =>'The user you are inviting must have a birdboard account.'
//        ]);

        $user = User::whereEmail(\request('email'))->first();

        $project->invite($user);

        return redirect($project->path())->with('message');
    }
}
