<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['user_id', 'project_id', 'subject_type', 'subject_id', 'type', 'description', 'changes'];

    protected $casts = [
        'changes' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function subject()
    {
        return $this->morphTo();
    }
}
