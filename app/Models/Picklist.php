<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'category',
        'is_custom',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class, 'type_id')
            ->orWhere('steering_id', $this->id)
            ->orWhere('brand_id', $this->id);
    }
}
