<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use phpDocumentor\Reflection\Types\True_;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function a_project_can_have_tasks()
    {
        $this->withoutExceptionHandling();

        $this->singIn();

        $project =Project::factory()->create(['owner_id' => auth()->id()]);

        $this->post($project->path().'/tasks', ['body' => 'Task task']);

        $this->get($project->path())->assertSee('Task task');
    }
    /** @test */
    public function a_task_requires_a_body()
    {
        $this->singIn();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path().'/tasks', $attributes)->assertSessionHasErrors('body');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        //$this->withoutExceptionHandling();

        $this->singIn();

        $project = Project::factory()->create();

        $this->post($project->path().'/tasks', ['body' => 'Task task'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body'=>'Task task']);
    }
    /** @test */
    public function a_task_can_be_updated()
    {
        //$this->withoutExceptionHandling();

        $this->singIn();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $task = $project->addTask('Task task');

        $this->patch($task->path(), [
            'body' => 'New task',
            'completed' => Carbon::now()
        ]);

        $this->assertDatabaseHas('tasks', ['body' => 'New task', 'completed' => Carbon::now()]);
    }
    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        //$this->withoutExceptionHandling();

        $this->singIn();

        $project = Project::factory()->create();
        // ['owner_id' => auth()->id()]

        $task = $project->addTask('Task task');

        $this->patch($task->path(), [
            'body' => 'changed',
            'completed' => Carbon::now()
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed', 'completed' => Carbon::now()]);
    }
}
