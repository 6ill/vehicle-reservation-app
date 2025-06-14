<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FuelLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'reservation_id',
        'refuel_date',
        'liters_filled',
        'cost',       
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

     public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
