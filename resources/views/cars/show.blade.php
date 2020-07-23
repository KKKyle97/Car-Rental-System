<?php 

use App\Common;

?>@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="show_specific_car_container word">
                    <div class="show_specific_car_box ">
                        <table class="table table-borderless">
                            <tr  style="text-align:center">
                                <td colspan='2'><img style="margin:auto" src="{{asset('storage/Cars/'.$car->photo)}}" width="200px" height="150px"></td>
                            </tr>
                            <tr>
                                <td>Manufacturer:</td>
                                <td>{{$car->make}}</td>
                            </tr>
                            <tr>
                                <td>Model:</td>
                                <td>{{$car->model}}</td>
                            </tr>
                            <tr>
                                <td>Car Plate Number:</td>
                                <td>{{$car->carPlateNo}}</td>
                            </tr>
                            <tr>
                                <td>Year:</td>
                                <td>{{$car->carYear}}</td>
                            </tr>
                            <tr>
                                <td>Category:</td>
                                <td>{{Common::$category[$car->category]}}</td>
                            </tr>
                            <tr>
                                <td>Rate Per Day:</td>
                                <td>RM{{$car->ratePerDay}}</td>
                            </tr>
                            <tr>
                                <td>Description:</td>
                                <td>{{$car->description}}</td>
                            </tr>

                        </table>
                        <div class="action_button">
                            <a href=" {{route('cars.index')}} " class="btn btn-primary word">Back</a>
                            <a href="{{ route('cars.edit',$car->id) }}" class="btn btn-warning word">Edit</a>
                            <form method="post" action="{{ route('cars.destroy',$car->id) }}" style="width:fit-content; float:right; margin-left:5px;" >
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                                <input type="submit" value="Delete" class="btn btn-danger word"/>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>     
@endsection