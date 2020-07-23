<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'carPlateNo',
        'make',
        'model',
        'carYear',
        'category',
        'ratePerDay',
        'description',
        'photo',
    ];

    public function rentalOrders(){
        return $this->hasMany(RentalOrder::class);
    }
}
