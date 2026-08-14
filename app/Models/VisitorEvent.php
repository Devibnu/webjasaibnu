<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class VisitorEvent extends Model
{
    protected $fillable = [
        'path',
        'route_name',
        'ip_hash',
        'user_agent_hash',
        'referer',
        'visited_on',
        'visited_at',
    ];

    protected $casts = [
        'visited_on' => 'date',
        'visited_at' => 'datetime',
    ];

    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('visited_on', today());
    }
}
