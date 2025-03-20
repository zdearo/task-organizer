<?php

namespace App\Enums;

enum TaskPriorityEnum: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Urgent = 'urgent';

    public function getLabel(): string
    {
        return match ($this) {
            self::Low     => __('Low'),
            self::Medium    => __('Medium'),
            self::High => __('High'),
            self::Urgent => __('Urgent'),
        };
    }

    public static function toArray(string $key): array
    {
      return array_column(TaskPriorityEnum::cases(), $key);
    } 
}
