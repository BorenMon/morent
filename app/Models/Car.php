<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Car extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'card_image',
        'images',
        'description',
        'type_id',
        'steering_id',
        'brand_id',
        'model',
        'gasoline',
        'capacity',
        'price',
        'has_promotion',
        'promotion_price',
        'rent_times',
        'rating',
    ];

    protected $casts = [
        'images' => 'array',
        'has_promotion' => 'boolean'
    ];

    public function type()
    {
        return $this->belongsTo(Picklist::class, 'type_id');
    }

    public function steering()
    {
        return $this->belongsTo(Picklist::class, 'steering_id');
    }

    public function brand()
    {
        return $this->belongsTo(Picklist::class, 'brand_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getImageUrlsAttribute()
    {
        return collect($this->images)->map(function ($imagePath) {
            return [
                'image_path' => $imagePath,
                'full_url'   => getAssetUrl($imagePath),
            ];
        })->toArray();
    }
}
