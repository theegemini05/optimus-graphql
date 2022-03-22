<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'registration_number', 'year_of_manufacture', 'vehicle_type', 'tonnage'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
