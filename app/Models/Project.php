<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordsActivity;

class Project extends Model
{
    use HasFactory, RecordsActivity;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function recentActivities()
    {
        return $this->activities()->latest()->take(5);
    }

    protected function recordActivity($event)
    {
        $this->activities()->create([
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
            'created' => 'a créé le projet',
            'updated' => 'a modifié le projet',
            'deleted' => 'a supprimé le projet',
            default => $event . ' le projet'
        };
    }
}
