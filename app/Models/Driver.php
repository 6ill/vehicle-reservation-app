<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'phone_number', 
        'is_available', 
        'location_id'
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
