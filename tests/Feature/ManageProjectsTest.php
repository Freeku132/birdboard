<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;


class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_projects()
    {
        //$this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->post('/projects', $project->toArray())->assertRedirect('login');
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path().'/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->singIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = Project::factory()->raw();

        $this->followingRedirects()->post('/projects', $attributes)
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_delete_a_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path())->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }
    /** @test */
    public function unauthorized_users_cannot_delete_projects()
    {
        $project = ProjectFactory::create();


        $this->delete($project->path())->assertRedirect('/login');

        $user = $this->singIn();

        $this->delete($project->path())->assertStatus(403);

        $project->invite($user);

        $this->actingAs($user)->delete($project->path())->assertStatus(403);

        //$this->assertDatabaseMissing('projects', $project->only('id'));
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        //$this->singIn();
        //$this->withoutExceptionHandling();
        //$project = Project::factory()->create(['owner_id' => auth()->id()]);
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
                'notes' => 'Changed',
                'title' => 'New title',
                'description' => 'Old'
            ]);

        $this->get($project->path().'/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);
    }
    /** @test */
    public function a_user_can_update_a_projects_general_notes()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
                'notes' => 'Changed',
            ]);

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path().'/edit')->assertOk();


    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->singIn();
        //$this->actingAs(User::factory()->create());

        //$this->withoutExceptionHandling();

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors(['title']);
    }
    /** @test */
    public function a_project_requires_a_description()
    {
        $this->singIn();

        //$this->actingAs(User::factory()->create());

        //$this->withoutExceptionHandling();

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors(['description']);
    }
    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->singIn();
       // $this->be(User::factory()->create());

       //$this->withoutExceptionHandling();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {

        $this-> be(User::factory()->create());

        //$this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);

    }
    /** @test */
    public function an_authenticated_user_cannot_update_the_projects_of_others()
    {

        $this-> be(User::factory()->create());

        //$this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->patch($project->path())->assertStatus(403);

    }

    /** @test */
    public function a_user_can_see_all_projects_they_been_invited_to_on_their_dashboard()
    {

        $this->withoutExceptionHandling();

        $user = $this->singIn();

        $project = tap(ProjectFactory::create())->invite($user); // zwraca Model projektu, nie rezultat metody której na nim wywołaliśmy
        //$project->invite($user);

        $this->get('/projects')->assertSee($project->title);
    }


}

