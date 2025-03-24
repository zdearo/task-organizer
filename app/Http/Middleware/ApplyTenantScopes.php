<?php

namespace App\Http\Middleware;

use App\Models\Task;
use App\Models\User;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ApplyTenantScopes
{
    public function handle(Request $request, Closure $next)
    {
        Task::addGlobalScope(
            fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        );

        User::addGlobalScope(function (Builder $query) {
            $query->whereHas('teams', function ($query) {
                $query->whereKey(Filament::getTenant()->getKey());
            });
        });

        return $next($request);
    }
}
