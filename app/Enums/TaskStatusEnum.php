<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case Canceled = 'canceled';
    case OnHold = 'on_hold';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending     => __('Pending'),
            self::InProgress    => __('In Progress'),
            self::Completed    => __('Completed'),
            self::Canceled => __('Canceled'),
            self::OnHold => __('On Hold'),
        };
    }

    public static function toArray(): array
    {
      return array_column(TaskStatusEnum::cases(), 'value');
    } 
}
