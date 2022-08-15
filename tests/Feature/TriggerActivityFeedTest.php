<?php

namespace Tests\Feature;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class TriggerActivityFeedTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function creating_a_project()
    {
       $project = ProjectFactory::create();

       $this->assertCount(1, $project->activity);
       $this->assertEquals('created', $project->activity->last()->description);
    }
    /** @test */
    public function update_a_project()
    {
        $project = ProjectFactory::create();

        $project->update([
            'title' => 'change'
        ]);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }
    /** @test */
    function creating_a_new_task()
    {
        $project = ProjectFactory::create();

        $project->addTask('some task');

        $this->assertCount(2, $project->activity);
        tap($project->activity->last(), function ($activity){
            $this->assertEquals('created_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
            $this->assertEquals('some task', $activity->subject->body);
        });

    }
    /** @test */
    function completing_a_new_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'foobar',
                'completed' => Carbon::now()
        ]);

        $this->assertCount(3, $project->activity);

        tap($project->activity->last(), function ($activity){
            $this->assertEquals('created_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
        });
    }
    /** @test */
    function incompleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'foobar',
                'completed' => Carbon::now()
            ]);

        $this->assertCount(3, $project->activity);


        $this->patch($project->tasks->first()->path(), [
                'body' => 'foobar',
                'completed' => NULL
            ]);
        $this->assertCount(4, $project->fresh()->activity);

        $this->assertEquals('incompleted_task', $project->fresh()->activity->last()->description);
    }
    /** @test */
    function deleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $project->tasks[0]->delete();

        $this->assertCount(3, $project->activity);
    }
}
