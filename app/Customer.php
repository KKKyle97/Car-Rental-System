<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'fullName',
        'icNumber',
        'telephoneNo',
        'driverLicenseNumber',
        'address',
        'city',
        'state',
        'zipCode',
        'email',
    ];

    public function rentalOrders(){
        return $this->hasMany(RentalOrder::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
