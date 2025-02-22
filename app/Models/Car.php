<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

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

    protected $appends = ['card_image_url', 'type', 'steering'];

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

    public function getCardImageUrlAttribute()
    {
        return getAssetUrl($this->card_image);
    }

    public function getTypeAttribute()
    {
        return $this->type_id? Picklist::find($this->type_id)->value : '';
    }

    public function getSteeringAttribute()
    {
        return $this->steering_id? Picklist::find($this->steering_id)->value : '';
    }
}
