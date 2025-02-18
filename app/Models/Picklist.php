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
}
