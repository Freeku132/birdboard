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
        foreach (self::recordableEvents() as $event){
            static::$event(function ($model) use ($event){
                $model->recordActivity($model->activityDescription($event));
            });

            if($event == 'updated'){
                static::updating(function ($model){
                    $model->oldAttributes = $model->getRawOriginal();
                });
            }
        }
    }

    public function activityDescription($description)
    {
        return "{$description}_".strtolower(class_basename($this));
    }


    public function recordActivity($description)
    {
        //var_dump(array_diff($this->old, $this->toArray()));
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project->id,
            'user_id' => ($this->project ?? $this)->owner->id
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

    /**
     * @return array
     */
    public static function recordableEvents(): array
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        } else {
            return ['created', 'updated', 'deleted'];
        }

    }
}
