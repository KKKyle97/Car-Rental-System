<?php 

use App\Common;

?>@extends('layouts.app')

@section('content')

<table class="customer_profile_table word">
    <tr>
        <td><img src="{{asset('/image_test/test.jpg')}}" class="rounded-circle" width="304" height="236"></td>
    </tr>
    <tr>
        <td><h3>{{$customer->fullName}}</h3></td>
    </tr>
    <tr>
        <td><h5>{{$customer->email}}</h5></td>
    </tr>
</table>

<div class="customer_profile_detail_container word">
    <div class="customer_profile_detail_box">
        <h4>IC NUMBER</h4>
        <p>{{$customer->icNumber}}</p>
    </div>

    <div class="customer_profile_detail_box word">
        <h4>TELEPHONE NUMBER</h4>
        <p>{{$customer->telephoneNo}}</p>
    </div>

    <div class="customer_profile_detail_box word">
        <h4>DRIVING LICENSE</h4>
        <p>{{$customer->driverLicenseNumber}}</p>
    </div>

    <div class="customer_profile_detail_box word">
        <h4>HOME ADDRESS</h4>
        <p>{{$customer->address}},{{$customer->city}},{{$customer->zipCode}} {{$customer->state}}</p>
        <p></p>
    </div>
    
</div>

@if(count($records)==0)
    <div style="margin:auto; width:fit-content; font-size:50px " class="word card">
        <p >No Rental Record!</p>
    </div>
@else
    <table class="table table-borderless table-hover customer_table table-light word">
    <thead> 
        <tr>
        <th>Order Id</th>
        <th>Rental Date</th>
        <th>Payment</th>
        <th></th>
        </tr>
    </thead>
    @foreach($records as $record)
    <tr>
        <td>{{$record->id}}</td>
        <td>{{$record->rentStartDate}} - {{$record->rentEndDate}}</td>
        <td>RM{{$record->total}}</td> 
        <td><a href="{{route('rentals.show',$record->id)}}" ><button class="btn btn-secondary word">View More</button></a></td>
    </tr>
    @endforeach
    </table>

@endif

<div class="cancel-btn">
    @if(Auth::user()->roles=='admin')
    <a href="{{route('customers.index')}}"  class="btn btn-primary word" style="margin:auto; width:fit-content;">Back</a>
    @else
    <a href="{{route('home')}}"  class="btn btn-primary word" style="margin:auto; width:fit-content;">Back</a>
    @endif
</div>

@endsection