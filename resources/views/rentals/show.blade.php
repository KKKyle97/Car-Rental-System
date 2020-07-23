<?php 

use App\Common;
use App\Customer;
?>@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="show_specific_rental_container word">
                        <table class="table table-borderless">
                            <tr  style="text-align:center">
                                <td colspan='2'><img style="margin:auto" img src ="/storage/Cars/{{$rental->car->photo}}" width="200px" height="150px"></td>
                            </tr>
                            <tr>
                                <td>Order ID:</td>
                                <td>{{$rental->id}}</td>
                            </tr>
                            <tr>
                                <td>Car:</td>
                                <td>{{$rental->car->model}}</td>
                            </tr>
                            <tr>
                                <td>Car Plate Number:</td>
                                <td>{{$rental->car->carPlateNo}}</td>
                            </tr>
                            <tr>
                                <td>Year:</td>
                                <td>{{$rental->car->carYear}}</td>
                            </tr>
                            <tr>
                                <td>Category:</td>
                                <td>{{Common::$category[$rental->car->category]}}</td>
                            </tr>
                            <tr>
                                <td>Rent date:</td>
                                <td>{{$rental->rentStartDate}} - {{$rental->rentEndDate}}</td>
                            </tr>
                            <tr>
                                <td>Total Price paid:</td>
                                <td>RM{{$rental->total}}</td>
                            </tr>
                            <tr>
                                <td>Customer Name:</td>
                                <td>{{$rental->customer->fullName}}</td>
                            </tr>
                            <tr>
                                <td>Customer IC:</td>
                                <td>{{$rental->customer->icNumber}}</td>
                            </tr>
                            <tr>
                                <td>Customer Phone Number:</td>
                                <td>{{$rental->customer->telephoneNo}}</td>
                            </tr>

                        </table>
                    </div>
            </div>
        </div>
    </div>

    <div class="cancel-btn">
    @if(Auth::user()->roles=='admin')
    <a href="{{route('rentals.index')}}"  class="btn btn-primary word" style="margin:auto; width:fit-content;">Back</a>
    @else
    <a href="{{route('customers.show',Auth::user()->email)}}"  class="btn btn-primary word" style="margin:auto; width:fit-content;">Back</a>
    @endif
    </div>



@endsection