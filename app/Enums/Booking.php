<?php

namespace App\Enums;

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

enum BookingPaymentStatus: string
{
  case Pending = 'PENDING';
  case Paid = 'PAID';
  case Refunding = 'REFUNDING';
  case Refunded = 'REFUNDED';

  public static function values(): array
  {
    return array_map(fn($enum) => $enum->value, self::cases());
  }
}

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
