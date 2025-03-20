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
                    ->required(),

                TextInput::make('description'),

                Select::make('status')
                    ->options(TaskStatusEnum::toArray('label'))
                    ->native(false)
                    ->required(),

                Select::make('priority')
                    ->options(TaskPriorityEnum::toArray('label'))
                    ->native(false)
                    ->required(),

                DatePicker::make('due_date'),

                Select::make('user_id')
                    ->label(__('Related User'))
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->native(false)
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Task $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Task $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Manage your tasks here.')
            ->columns([
                    TextColumn::make('user.name'),

                    TextColumn::make('title')
                        ->searchable()
                        ->sortable(),

                    TextColumn::make('description'),


                    TextColumn::make('priority'),

                    TextColumn::make('due_date')
                        ->date(),

                    TextColumn::make('completed_at')
                        ->label('Completed Date')
                        ->date(),

                    SelectColumn::make('status')
                        ->options(TaskStatusEnum::toArray('label'))
                ])
                ->filters([
                    //
                ])
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
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
