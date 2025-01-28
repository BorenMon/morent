<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Booking extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'customer_id',
        'car_id',
        'pick_up_city',
        'pick_up_datetime',
        'drop_off_city',
        'drop_off_datetime',
        'stage',
        'payment_status',
        'progress_status',
        'name',
        'phone',
        'address',
        'total_amount',
        'payment_proof',
    ];

    protected $casts = [
        'pick_up_datetime' => 'datetime',
        'drop_off_datetime' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
