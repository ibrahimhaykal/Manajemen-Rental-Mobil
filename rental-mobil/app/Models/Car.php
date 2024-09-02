<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['id','brand', 'model', 'license_plate', 'rental_rate_per_day', 'availability', 'image'];

    /**
     * Get the rentals for the car.
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class, 'car_id', 'id');
    }
}
