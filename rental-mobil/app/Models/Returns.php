<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id', // Add rental_id here
        'return_date',
        'rental_cost',
        'status',
    ];

    /**
     * Get the rental that owns the return.
     */
    public function rental()
    {
        
        return $this->belongsTo(Rental::class, 'rental_id', 'id_rental');
    }
    
}
