<?php 

use App\Common;
use App\Customer;
?>@extends('layouts.app')

@section('content')


    <div class="justify-content-center">
        <div class="col-md-8" style=" margin:auto;">
            <div class="card">
                <div class="container word" style="width:70%;height:auto; padding:5%;">
                    <form action="{{route('rentals.search')}}" method="get" >

                        <div class="form-group row word">
                            {!! Form::label('carname','Name',[
                            'class' => 'control-label col-sm-3 label text-right',
                            ]) !!}
                            <div class="col-sm-7">     
                            {!! Form::text('car_name',null,[
                                'class' =>'form-control',
                                'placeholder'=>'Enter Car Name (Optional)']) !!}
                            </div>
                        </div>

                        <div class="form-group row word">
                            {!! Form::label('car_catogry','Category',[
                            'class' => 'control-label col-sm-3 label text-right',
                            ]) !!}
                            <div class="col-sm-7">   
                            {!! Form::select('category',Common::$category,null,[
                                'class' =>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row word">
                            {!! Form::label('pickup-date','Pickup Date',[
                            'class' => 'control-label col-sm-3 label text-right',
                            ]) !!}
                            <div class="col-sm-7">  
                            {!! Form::date('pickup_date',null,[
                                'class' => 'form-control',
                                'id' => 'from',
                                'required' =>'true',
                                'onchange' => 'validateDate()'])!!}
                            </div>
                        </div>

                        <div class="form-group row ">
                            {!! Form::label('return-date','Return Date',[
                            'class' => 'control-label col-sm-3 label text-right word',
                            ]) !!}
                            <div class="col-sm-7">  
                            {!! Form::date('return_date',null,[
                                'class' => 'form-control',
                                'id' => 'to',
                                'required' =>'true',
                                'onchange' => 'validateDate()'])!!}
                            </div>
                        </div>

                        <div class="form-group row word">
                            {!! Form::button('Search',[
                            'type' => 'submit',
                            'class' => 'btn btn-lg btn-primary mx-auto word'])!!}
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="cancel-btn">
    <a href="{{route('home')}}"  class="btn btn-primary word" style="margin:auto; width:fit-content;">Back</a>
</div>
    <script>

 

    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("pickup_date")[0].setAttribute('min', today);


    function validateDate()
    {
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("pickup_date")[0].setAttribute('min', today);

    var current_day = new Date(today); 
    var selected_start_date = new Date(document.getElementById('from').value);
    var selected_end_date = new Date(document.getElementById('to').value);

    var start_date =  new Date(selected_start_date).toISOString().split('T')[0];
    document.getElementsByName("return_date")[0].setAttribute('min', start_date);


        if(selected_end_date<selected_start_date)
        {
            document.getElementById('to').value = null;
        }

        if(selected_start_date<current_day)
        {
            document.getElementById('from').value = null;
        }

    }

</script>
@endsection