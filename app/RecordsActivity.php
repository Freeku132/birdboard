<?php

namespace App;

use App\Models\Activity;

trait RecordsActivity
{
    public $oldAttributes = [];

    /**
     * Boot the trait
     */
    public static function bootRecordsActivity()
    {
        static::updating(function ($model){
            $model->oldAttributes = $model->getRawOriginal();
        });

        if (isset(static::$recordableEvents)){

            $recordableEvents = static::$recordableEvents;
        }else {
            $recordableEvents = ['created', 'updated', 'deleted'];
        }

        foreach ($recordableEvents as $event){
            static::$event(function ($model) use ($event){
                if (class_basename($model) != 'Project'){
                    $event = "{$event}_".strtolower(class_basename($model));
                }
                $model->recordActivity($event);
            });
            }
        }


    public function recordActivity($description)
    {
        //var_dump(array_diff($this->old, $this->toArray()));
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project->id
        ]);

    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => array_diff($this->oldAttributes, $this->getAttributes()),
                'after' => $this->getChanges(),
                //'after' => array_diff($this->getAttributes(),$this->old)
            ];
        }
    }
}
