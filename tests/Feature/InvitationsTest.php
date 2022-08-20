<?php

namespace Tests\Feature;

use App\Http\Controllers\ProjectTasksController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_owners_may_not_invite_users()
    {
        $this->actingAs(User::factory()->create())
            ->post(ProjectFactory::create()->path().'/invitations')
            ->assertStatus(403);
    }

    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $userToInvite = User::factory()->create();



        $this->actingAs($project->owner)->post($project->path().'/invitations',[
            'email' => $userToInvite->email
        ])->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($userToInvite));
    }

    /** @test */
    public function the_email_must_be_associated_with_a_valid_birboard_account()
    {
        $project = ProjectFactory::create();


        $this->actingAs($project->owner)->post($project->path().'/invitations',[
            'email' => 'notauser@example.com'
        ])->assertSessionHasErrors([
            'email' => 'The user you are inviting must have a birdboard account.'
        ]);

    }

    /** @test */
    public function invited_users_may_update_project_details()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = User::factory()->create());

        $this->singIn($newUser);

        $this->post(action('App\Http\Controllers\ProjectTasksController@store', $project), $task = ['body'=>'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
