<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use App\Models\Task;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Enums\TaskStatusEnum;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $taskStatus = TaskStatusEnum::toArray('name');
        $tabs = [];

        foreach ($taskStatus as $status) {
            $statusValue = TaskStatusEnum::{$status};
            $tabs[$statusValue->value] =
                Tab::make($statusValue->getLabel())
                    ->badge(fn(): int => Task::where('status', $statusValue)->count())
                    ->badgeColor($statusValue->getColor())
                    ->query(fn(Builder $query): Builder => $query->where('status', $statusValue));
        }

        return $tabs;
    }
}
