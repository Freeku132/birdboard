<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProjectInvitationRequest extends FormRequest
{
    protected $errorBag = 'invitations';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $project = $this->route('project');

         return Gate::allows('manage', $project);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['bail','required', 'exists:users,email',
            function($attribute, $value, $fail){

                $project = $this->route('project');
                $user = DB::table('users')->where('email', $value);

                if($project->owner->email === $value){
                    $fail('You cannot add yourself to the project.');
                }

                $result = DB::table('project_members')->where([
                    ['project_id', $project->id],
                    ['user_id', $user->first()->id]
                ])->exists();

                if ($result){
                    $fail('The user has been already invited to the project.');
                }
            }
        ]
        ];
    }

    public function messages()
    {
        return[
            'email.exists' => 'The user you are inviting must have a birdboard account.',
            'email.fail' => 'You cannot add yourself to the project.'
        ];
    }
}
