<?php

namespace App\Enums;

use Filament\Support\Colors\Color;

enum TaskStatusEnum: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Canceled = 'canceled';
    case OnHold = 'on_hold';
    case Completed = 'completed';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending     => __('Pending'),
            self::InProgress  => __('In Progress'),
            self::Canceled    => __('Canceled'),
            self::OnHold      => __('On Hold'),
            self::Completed   => __('Completed'),
        };
    }

    public function getColor(): array
    {
        return match ($this) {
            self::Pending    => Color::Gray,
            self::InProgress => Color::Blue,
            self::Canceled   => Color::Red,
            self::OnHold     => Color::Yellow,
            self::Completed  => Color::Green,
        };
    }

    public static function toArray(string $key): array
    {
        return array_combine(
            array_map(fn ($case) => $case->value, self::cases()),
            array_map(fn ($case) => match ($key) {
                'name'      => $case->name,
                'value'     => $case->value,
                'label'     => $case->getLabel(),
                'color'     => $case->getColor(),
                default     => throw new \InvalidArgumentException("Chave inválida: {$key}")
            }, self::cases())
        );
    }
}
