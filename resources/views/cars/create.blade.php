<?php 

use App\Common;

?>@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <form action="{{ route('cars.store') }}" method="POST" class="admin_form word" enctype="multipart/form-data" onSubmit="return confirm('Are you sure you wish to register this car?');">
                    <h1>Register new car</h1>
                        @csrf
                        <div class="form-group">
                            <label>Car plate number:</label>
                            <input type="text" class="form-control @error('carPlateNo') is-invalid @enderror" name="carPlateNo" id="carPlateNo" maxlength="7"/>
                        </div>
                        @error('carPlateNo')
                            <div class="alert alert-danger ">{{ $message }}</div>
                        @enderror
                        <div class="form-group" id="current_make">
                            <label>Available Manufacturer:</label>
                            <input name="make" id="manu" class="form-control @error('make') is-invalid @enderror">
                        </div>
                        @error('make')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group" id="model">
                            <label>Model:</label>
                            <input name="model" id="selectedModel" class="form-control @error('model') is-invalid @enderror">
                        </div>
                        @error('model')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Car year:</label>
                            <input type="text" class="form-control @error('carYear') is-invalid @enderror" name="carYear" id="carYear" maxlength="4"/>
                        </div>
                        @error('carYear')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group" id="category">
                            <label>Category:</label>
                            {!! Form::select('category',Common::$category,null,[
                                'class' => 'form-control',
                            ]) !!}
                            </div>
                        <div class="form-group">
                            <label>Rate per day</label>
                            <input type="number" class="form-control @error('ratePerDay') is-invalid @enderror" name="ratePerDay" id="ratePerDay" step="0.01"/>
                        </div>
                        @error('ratePerDay')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" id="image"/>
                        </div>
                        @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label>Description</label>
                            <input type="textarea" rows="10" class="form-control @error('description') is-invalid @enderror" name="description" id="description"/>
                        </div>
                        @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="submit" class="btn btn-success word"/>
                        <a href="{{route('home')}}"  class="btn btn-primary word">Cancel</a>
                    </form>
                    
            </div>
        </div>
    </div>
</div>
@endsection