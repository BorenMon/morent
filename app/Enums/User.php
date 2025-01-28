<?php

namespace App\Enums;

enum UserRole: string
{
  case Admin = 'ADMIN';
  case Customer = 'CUSTOMER';
  case Manager = 'MANAGER';
  case Staff = 'STAFF';

  public static function values(): array
  {
    return array_map(fn($enum) => $enum->value, self::cases());
  }
}
