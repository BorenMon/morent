<?php

namespace app\Enums;

enum BookingStage: string
{
  case Booking = 'BOOKING';
  case Renting = 'RENTING';
  case History = 'HISTORY';

  public static function values(): array
  {
    return array_map(fn($enum) => $enum->value, self::cases());
  }
}
