<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'brand',
        'model',
        'license_plate',
        'rental_rate',
        'rental_name',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rental()
    {
        return $this->hasOne(Rental::class);
    }
}
