<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Models\Task;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\SelectColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Enums\TaskStatusEnum;
use App\Enums\TaskPriorityEnum;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Grouping\Group;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Builder;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $slug = 'tasks';

    protected static ?string $navigationIcon = 'heroicon-c-list-bullet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('Title'))
                    ->required(),

                TextInput::make('description')
                    ->label(__('Description')),

                Select::make('status')
                    ->label(__('Status'))
                    ->options(TaskStatusEnum::toArray('label'))
                    ->native(false)
                    ->required(),

                Select::make('priority')
                    ->label(__('Priority'))
                    ->options(TaskPriorityEnum::toArray('label'))
                    ->native(false)
                    ->required(),

                DatePicker::make('due_date')
                    ->label(__('Due Date')),

                Select::make('user_id')
                    ->label(__('Related User'))
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->native(false)
                    ->required(),

                Placeholder::make('created_at')
                    ->label(__('Created Date'))
                    ->content(fn(?Task $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label(__('Last Modified Date'))
                    ->content(fn(?Task $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Manage your tasks here.')
            ->columns([
                    TextColumn::make('user.name')
                        ->label(__('Related User')),

                    TextColumn::make('title')
                        ->label(__('Title'))
                        ->searchable()
                        ->sortable(),

                    TextColumn::make('description')
                        ->label(__('Description')),

                    TextColumn::make('due_date')
                        ->label(__('Due Date'))
                        ->date(),

                    TextColumn::make('completed_at')
                        ->label(__('Completed Date'))
                        ->date(),

                    SelectColumn::make('status')
                        ->label(__('Status'))
                        ->options(TaskStatusEnum::toArray('label')),

                    TextColumn::make('priority')
                        ->label(__('Priority'))
                        ->formatStateUsing(fn (string $state): HtmlString => new HtmlString(TaskPriorityEnum::tryFrom($state)->getLabel()))
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            '1' => 'gray',
                            '2' => 'info',
                            '3' => 'warning',
                            '4' => 'danger',
                        })
                ])
                ->defaultGroup('priority')
                ->groups([
                    Group::make('priority')
                        ->titlePrefixedWithLabel(false)
                        ->getTitleFromRecordUsing(fn (Task $record): string => TaskPriorityEnum::tryFrom($record->priority)->getLabel())
                        ->orderQueryUsing(fn (Builder $query) => $query->orderBy('priority', 'desc')),
                ])
                ->groupingSettingsHidden()
                ->actions([
                    EditAction::make(),
                    DeleteAction::make(),
                ])
                ->bulkActions([
                    BulkActionGroup::make([
                        DeleteBulkAction::make(),
                    ]),
                ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
//            'create' => Pages\CreateTask::route('/create'),
//            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }

    #[\Override]
    public static function getNavigationLabel(): string
    {
        return __('Tasks');
    }

    #[\Override]
    public static function getModelLabel(): string
    {
        return __('Task');
    }

    #[\Override]
    public static function getPluralModelLabel(): string
    {
        return __('Tasks');
    }
}
