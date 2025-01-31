<?php

namespace app\Enums;

enum BookingProgressStatus: string
{
  case Pending = 'PENDING';
  case InProgress = 'IN_PROGRESS';
  case Cancelled = 'CANCELLED';
  case Completed = 'COMPLETED';

  public static function values(): array
  {
    return array_map(fn($enum) => $enum->value, self::cases());
  }
}
