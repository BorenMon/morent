<?php

namespace app\Enums;

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
