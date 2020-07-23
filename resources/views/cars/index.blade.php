<?php 

use App\Common;

?>@extends('layouts.app')

@section('content')

<div class="display_all_car_wrapper">
   @foreach($cars as $car)
    <div class="display_single_car_box word">
        <ul>
            <li><img src="storage/Cars/{{$car->photo}}" width="200px" height="150px" style="margin-bottom:10px"></li>
            
            <li>Manufacturer: {{$car->make}}</li>
            <li>Model: {{$car->model}}</li>
            <li>Car Plate Number: {{$car->carPlateNo}}</li>
            <li>Year: {{$car->carYear}}</li>
            <li>Rate/Day:RM{{$car->ratePerDay}}</li>
        </ul>
        <div class="action_button">
            <a href="{{ route('cars.show',$car->id) }}" class="btn btn-primary word">View</a>
            <a href="{{ route('cars.edit',$car->id) }}" class="btn btn-warning word">Edit</a>
            <form method="post" action="{{ route('cars.destroy',$car->id) }}" style="width:fit-content; float:right; margin-left:5px;" onSubmit="return confirm('Are you sure you wish to delete?');" >
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
                <input type="submit" value="Delete" class="btn btn-danger word"/>
            </form>
            
        </div>
    </div>
   @endforeach
</div>
<div class="cancel-btn">
{{$cars->links()}}
</div>

<div class="cancel-btn">
    <a href="{{route('home')}}"  class="btn btn-primary word" style="margin:auto; width:fit-content;">Back</a>
</div>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endsection