<?php

namespace App\Enums;

use Filament\Support\Colors\Color;

enum TaskPriorityEnum: int
{
    case Urgent = 4;
    case High = 3;
    case Medium = 2;
    case Low = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::Low       => __('Low'),
            self::Medium    => __('Medium'),
            self::High      => __('High'),
            self::Urgent    => __('Urgent'),
        };
    }

    public function getColor(): array
    {
        return match ($this) {
            self::Low       => Color::Gray,
            self::Medium    => Color::Blue,
            self::High      => Color::Red,
            self::Urgent    => Color::Yellow,
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
