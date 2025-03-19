<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status', 'priority', 'due_date', 'completed_at', 'user_id'];

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
