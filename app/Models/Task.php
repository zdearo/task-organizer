<?php

namespace App\Models;

use App\Observers\TaskObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(TaskObserver::class)]
class Task extends Model
{
    protected $fillable = ['title', 'description', 'status', 'priority', 'due_date', 'completed_at', 'user_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts()
    {
        return [
            'due_date' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }
}
