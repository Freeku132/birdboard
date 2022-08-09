<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

        $this->post('/projects/store', $project->toArray())->assertRedirect('login');
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->singIn();

        $this->withoutExceptionHandling();

        //$this->actingAs(User::factory()->create());

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            //'owner_id' => User::factory()->create()->id

        ];

        $this->post('/projects/store', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }
    /** @test */
    public function a_project_requires_a_title()
    {
        $this->singIn();
        //$this->actingAs(User::factory()->create());

        //$this->withoutExceptionHandling();

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects/store', $attributes)->assertSessionHasErrors(['title']);
    }
    /** @test */
    public function a_project_requires_a_description()
    {
        $this->singIn();

        //$this->actingAs(User::factory()->create());

        //$this->withoutExceptionHandling();

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects/store', $attributes)->assertSessionHasErrors(['description']);
    }
    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->singIn();
       // $this->be(User::factory()->create());

       $this->withoutExceptionHandling();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description)->assertSee($project->owner_id);
    }
    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {

        $this-> be(User::factory()->create());

        //$this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);

    }

}

