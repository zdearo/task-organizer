<?php

namespace App\Models;

use App\Observers\TeamObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(TeamObserver::class)]
class Team extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'email',
        'avatar'
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}