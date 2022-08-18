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
    public function a_project_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = User::factory()->create());

        $this->singIn($newUser);

        $this->post(action('App\Http\Controllers\ProjectTasksController@store', $project), $task = ['body'=>'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
