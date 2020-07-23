<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalOrder extends Model
{
    //
    protected $fillable = [
        'rentStartDate',
        'rentEndDate',
        'rentStartTime',
        'rentEndTime',
        'total',
        'car_id',
        'customer_id',
    ];

    public function car(){
        return $this->belongsTo(Car::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
