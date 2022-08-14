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

        $this->post('/projects/store', $project->toArray())->assertRedirect('login');
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path().'/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->singIn();

        //$this->actingAs(User::factory()->create());

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            //'owner_id' => User::factory()->create()->id
            'notes' => 'General notes here.'

        ];

        $response = $this->post('/projects/store', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
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


}

