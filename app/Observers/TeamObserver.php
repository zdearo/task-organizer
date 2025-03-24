<?php

namespace App\Observers;

use App\Models\Team;
use Str;

class TeamObserver
{
    public function creating(Team $team): void
    {
        $team->code = rand(100000, 999999);
        $team->slug = Str::slug($team->name, '-');
    }

    /**
     * Handle the Team "created" event.
     */
    public function created(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "updated" event.
     */
    public function updated(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "deleted" event.
     */
    public function deleted(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "restored" event.
     */
    public function restored(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "force deleted" event.
     */
    public function forceDeleted(Team $team): void
    {
        //
    }
}
