<?php 

use App\Common;

?>@extends('layouts.app')

@section('content')
<style>

.label{
    color:white;
    font-size:20px;
}

</style>

@if((Auth::user()->roles=='admin') && (count($orders)>0))
<table class="table table-borderless table-hover customer_table table-light word ">
    <thead> 
        <tr>
        <th>Order Id</th>
        <th>Customer Name</th>
        <th>Car</th>
        <th>Rental Date</th>
        <th>Payment</th>
        <th></th>
        </tr>
    </thead>
    @foreach($orders as $order)
    <tr>
        <td>{{$order->id}}</td>
        <td>{{$order->customer->fullName}}</td>
        <td>{{$order->car->make}} {{$order->car->model}}</td>
        <td>{{$order->rentStartDate}} - {{$order->rentEndDate}}</td>
        <td>RM{{$order->total}}</td> 
        <td><a href="{{route('rentals.show',$order->id)}}" class="btn btn-secondary">View More</a></td>
    </tr>
    @endforeach
    </table>

@else
<div class="cancel-btn word">
    <p>No record found</p>
</div>

@endif

<div class="cancel-btn">
{{$orders->links()}}
</div>


<div class="cancel-btn">
    <a href="{{route('home')}}"  class="btn btn-primary word" style="margin:auto; width:fit-content;">Back</a>
</div>

@endsection