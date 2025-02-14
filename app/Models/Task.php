<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordsActivity;

class Task extends Model
{
    use HasFactory, RecordsActivity;

    protected $fillable = [
        'title',
        'description',
        'status',
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected function getActivityDescription($event)
    {
        return match($event) {
            'created' => 'a créé une nouvelle tâche',
            'updated' => 'a modifié la tâche',
            'deleted' => 'a supprimé la tâche',
            default => parent::getActivityDescription($event)
        };
    }

    public function getPriorityClasses()
    {
        return match($this->priority) {
            'high' => 'bg-red-100 text-red-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'low' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}
