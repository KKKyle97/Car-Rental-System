<?php 

use App\Common;
use App\Customer;
?>@extends('layouts.app')

@section('content')

<style>

  fieldset 
	{
		border: 1px solid #ddd !important;
		margin-top: 10px;
		xmin-width: 0;
		padding: 10px;   
		position: relative;
		border-radius:4px;
		background-color:#f5f5f5;
		padding-left:10px!important;
	}	
	
	legend
		{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px; 
			width: 35%; 
			border: 1px solid #ddd;
			border-radius: 4px; 
			padding: 5px 5px 5px 10px; 
			background-color: #ffffff;
		}
  
  label{
    font-size:17px;
  }

</style>

<body onload="pricing()">
    <div class="container border card word" style="padding:3%;">
    <h2 style="width:fit-content; margin:auto; padding:1%;">Renting Car Form</h2>
        <div class="form-group row">
            @if(Storage::disk('public')->exists('Cars/'.$car->photo))
            <img src ="/storage/Cars/{{$car->photo}}" width="300" height="230"  style="margin:10px;" class="mx-auto d-block" >
            @endif
        </div>

            {!! Form::model($rental, [
            'route' => ['rentals.store'],
            'method' => 'POST',
            'enctype' => 'multipart/form-data',
            'onSubmit' => 'return confirm("Are you sure you wish to book this car?");',
            ])!!}

        <fieldset>
        <legend> Car Details </legend>
        <div class="form-group row">
          {!! Form::label('car-make','Car Make',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::text('car_make', $car->make,[
              'class' => 'form-control',
              'readonly'=>'true',])!!}
            </div>
        </div>

        <div class="form-group row">
          {!! Form::label('car-model','Car Model',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::text('car_model', $car->model,[
              'class' => 'form-control',
              'readonly'=>'true',])!!}
            </div>
        </div>

        <div class="form-group row">
          {!! Form::label('car-year','Car Year',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::text('car_year', $car->carYear,[
              'class' => 'form-control',
              'readonly'=>'true',])!!}
            </div>
        </div>

        <div class="form-group row">
          {!! Form::label('car-category','Car Category',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::text('car_category', Common::$category[$car->category],[
              'class' => 'form-control',
              'readonly'=>'true',])!!}
            </div>
        </div>

        <div class="form-group row">
          {!! Form::label('car-plate','Car Plate No',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::text('car_plate', $car->carPlateNo,[
              'class' => 'form-control',
              'readonly'=>'true',])!!}
            </div>
        </div>

        <div class="form-group row">
          {!! Form::label('car-rate','Rate Per Day (RM)',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::text('car_rate', $car->ratePerDay,[
              'class' => 'form-control',
              'readonly'=>'true',])!!}
            </div>
        </div>
        </fieldset>
        <hr>
        <fieldset>
        <legend> Order Details</legend>

        <div class="form-group row">    
          {!! Form::label('oh','Operating Hours',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              <b>{!! Form::label('o_h','8:00AM - 8:00PM',['class' => 'control-label col-sm-5']) !!}</b>
            </div>
        </div>

        <div class="form-group row">
          {!! Form::label('pickup-date','Pickup Date',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::date('rentStartDate', $pickup_date,[
              'class' => 'form-control',
              'id'=>'pickup',
              'readonly'=>'true',
              'onchange'=>'pricing()'])!!}
            </div>
        </div>

        <div class="form-group row">
          {!! Form::label('return-date','Return Date',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::date('rentEndDate', $return_date,[
              'class' => 'form-control',
              'readonly'=>'true',
              'id'=>'return',
              'onchange'=>'pricing()'])!!}
            </div>
        </div>

        <div class="form-group row">
          {!! Form::label('pickup-time','Pickup Time',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::time('rentStartTime', null,[
              'class' => 'form-control',
              'id' => 'from',
              'required' => 'true',
              'onchange'=> 'validateTime()'])!!}
            </div>
        </div>

        <div class="form-group row">
          {!! Form::label('return-time','Return Time',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::time('rentEndTime', null,[
              'class' => 'form-control',
              'id' => 'to',
              'required' => 'true',
              'onchange'=> 'validateTime()'])!!}
            </div>
        </div>

        <div class="form-group row">
          {!! Form::label('price','Total Price (RM)',['class' => 'control-label col-sm-3 text-right']) !!}
            <div class="col-sm-7">
              {!! Form::text('total',null,[
              'class' => 'form-control',
              'id' =>'wrapper',
              'readonly'=>'true'])!!}
            </div>
        </div>
        </fieldset>
        
        <div style="padding-top:10px;padding-left:40%;">
        {!! Form::text('car_id', $car->id,[
        'class' => 'form-control',
        'hidden' => 'true'])!!}
      
        {!! Form::button('Confirm',[
        'type'=> 'submit',
        'class' => 'btn btn-lg btn-success word'])!!}
        <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
        </div>

</body>

<script>
    function pricing()
    {
        var pickup_date = new Date(document.getElementById('pickup').value);
        var return_date = new Date(document.getElementById('return').value);     
        var res = Math.abs(return_date - pickup_date) / 1000;
        var days = Math.floor(res / 86400);    
        var price = <?php echo $car->ratePerDay ?> *(days+1);
        var wrapper = document.getElementById('wrapper');
        wrapper.value =price;
    }

    function validateTime()
    {
        var start_time = document.getElementById('from').value;
        var return_time = document.getElementById('to').value;

        if(start_time<"08:00" || start_time>"20:00")
        {
        document.getElementById('from').value =null;
        }

        if (return_time>"20:00" || return_time<"08:00" )
        {
        document.getElementById('to').value =null;
        }

        var start_date = new Date(document.getElementById('pickup').value);
        var end_date = new Date(document.getElementById('return').value);
        var check_start = Boolean(start_date>end_date);
        var check_end = Boolean(start_date<end_date);
        if(check_start== false && check_end==false)
        {
        if (return_time<start_time)
        {
            document.getElementById('to').value =null;
        }
        }

    }
</script>
@endsection