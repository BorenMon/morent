<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    // Disable timestamps
    public $timestamps = false;

    // Define the table name (if different from default)
    protected $table = 'visits';

    // Define fillable attributes (columns that can be mass-assigned)
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'visited_at',
    ];

    // Define the primary key type if it's UUID
    protected $keyType = 'string';  // UUID uses string as the key type

    // If you're using UUIDs for your primary key (not auto-incrementing)
    public $incrementing = false;

    // If 'visited_at' is a datetime column, ensure it’s cast to a Carbon instance
    protected $dates = [
        'visited_at',
    ];

    // Define any relationships here, e.g., the relation to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
