<?php

namespace App\Traits;

use App\Models\Activity;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        foreach (static::getActivitiesToRecord() as $event) {
            if ($event !== 'deleted') { // Skip deleted event
                static::$event(function ($model) use ($event) {
                    $model->recordActivity($event);
                });
            }
        }
    }

    protected static function getActivitiesToRecord()
    {
        return ['created', 'updated'];
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    protected function recordActivity($event)
    {
        $this->project->activities()->create([
            'user_id' => auth()->id(),
            'subject_type' => get_class($this),
            'subject_id' => $this->id,
            'type' => $event,
            'description' => $this->getActivityDescription($event),
            'changes' => $this->getActivityChanges($event)
        ]);
    }

    protected function getActivityDescription($event)
    {
        return match($event) {
            'created' => 'a créé ' . $this->getActivitySubjectType(),
            'updated' => 'a modifié ' . $this->getActivitySubjectType(),
            'deleted' => 'a supprimé ' . $this->getActivitySubjectType(),
            default => $event . ' ' . $this->getActivitySubjectType()
        };
    }

    protected function getActivitySubjectType()
    {
        return strtolower(class_basename($this));
    }

    protected function getActivityChanges($event)
    {
        if ($event === 'created') {
            return null;
        }

        if ($event === 'updated') {
            return [
                'before' => array_intersect_key($this->getOriginal(), $this->getDirty()),
                'after' => $this->getDirty()
            ];
        }

        return null;
    }
}