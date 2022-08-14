<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function creating_a_project_records_activity()
    {
       $project = ProjectFactory::create();

       $this->assertCount(1, $project->activity);
       $this->assertEquals('created', $project->activity->last()->description);
    }
    /** @test */
    public function update_a_project_records_activity()
    {
        $project = ProjectFactory::create();

        $project->update([
            'title' => 'change'
        ]);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }
    /** @test */
    function creating_a_new_task_records_project_activity()
    {
        $project = ProjectFactory::create();

        $project->addTask('some task');

        $this->assertCount(2, $project->activity);
        $this->assertEquals('created_task', $project->activity->last()->description);
    }
    /** @test */
    function completing_a_new_task_records_project_activity()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'foobar',
                'completed' => Carbon::now()
        ]);

        $this->assertCount(3, $project->activity);
        $this->assertEquals('completed_task', $project->activity->last()->description);
    }
}
