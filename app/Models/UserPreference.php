<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = [
        'theme',
        'language',
        'email_notifications',
        'dashboard_widgets',
        'default_view'
    ];

    protected $casts = [
        'email_notifications' => 'boolean',
        'dashboard_widgets' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
