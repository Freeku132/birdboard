<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;



class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_project()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }

    /** @test */
    public function it_has_a_path()
    {
        //$project = Project::factory()->create();
       $task = Task::factory()->create();

        $this->assertEquals('/projects/'.$task->project->id.'/tasks/'. $task->id , $task->path());
    }
    /** @test */
    public function it_can_be_completed()
    {
        $task = Task::factory()->create();

        $this->assertNull($task->completed);

        $task->complete();

        $this->assertNotNull($task->fresh()->completed);
    }
    /** @test */
    public function it_can_be_uncompleted()
    {
        $task = Task::factory()->create();

        $task->complete();

        $this->assertNotNull($task->completed);

        $task->uncomplete();

        $this->assertNull($task->fresh()->completed);
    }

}
