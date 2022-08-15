<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    protected $guarded =[];

    protected $touches = ['project'];

//    protected static function boot()
//    {
//        parent::boot(); // TODO: Change the autogenerated stub
//
//        static::created(function ($task){
//            $task->project->recordActivity('created_task');
//        });
//        static::deleted(function ($task){
//            $task->project->recordActivity('deleted_task');
//        });
//    }
    public function complete()
    {
        $this->update(['completed' => Carbon::now()]);

        $this->recordActivity('completed_task');
    }
    public function incomplete()
    {
        $this->update(['completed' => NULL]);

        $this->recordActivity('incompleted_task');
    }
    public function updated_task()
    {
        $this->update(['body' => $this->body]);

        $this->recordActivity('updated_task');
    }


    public function project()
    {
        return $this->belongsTo(Project::class );
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }
    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'project_id' => $this->project->id
        ]);

    }

}
