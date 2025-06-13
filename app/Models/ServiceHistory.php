<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    use HasFactory;

    protected $table = 'service_history';

    protected $fillable = [
        'vehicle_id',
        'service_date',
        'service_details',
        'cost',
    ];

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
