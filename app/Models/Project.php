<?php

namespace App\Models;

use App\RecordsActivity;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use RecordsActivity;
    use HasFactory;

    protected $guarded =[];

    //public $old = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function path()
    {
        return "/projects/{$this->id}";
    }
    public function owner()
    {
        return $this->belongsTo(User::class );
    }
    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }
//    public function recordActivity($description)
//    {
//        //var_dump(array_diff($this->old, $this->toArray()));
//        $this->activity()->create([
//            'description' => $description,
//            'changes' => $this->activityChanges(),
//            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project->id
//        ]);
//    }
//    protected function activityChanges()
//    {
//        if ($this->wasChanged()) {
//            return [
//                'before' => array_diff($this->old, $this->getAttributes()),
//                'after' => $this->getChanges(),
//                //'after' => array_diff($this->getAttributes(),$this->old)
//            ];
//        }
//    }

}
