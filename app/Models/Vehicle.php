<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'license_plate',
        'type',
        'ownership',
        'status',
        'base_location_id'
    ];

    public function baseLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'base_location_id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function fuelLogs(): HasMany
    {
        return $this->hasMany(FuelLog::class);
    }

    public function serviceHistory(): HasMany
    {
        return $this->hasMany(ServiceHistory::class);
    }
}
