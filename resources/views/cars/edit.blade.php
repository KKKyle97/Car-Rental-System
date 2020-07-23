<?php 

use App\Common;

?>@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card word">
                <form action="{{ route('cars.update',$car->id) }}" method="POST" class="admin_form word" enctype="multipart/form-data" onSubmit="return confirm('Are you sure you wish to update the info?');">
                    @method('PUT')
                    @csrf
                    <h1>Edit Car Info</h1>
                    <div class="form-group">
                        <label>Car plate number:</label>
                        <input type="text" class="form-control @error('carPlateNo') is-invalid @enderror"  name="carPlateNo" value="{{$car->carPlateNo}}" maxlength="7"/>
                    </div>
                    @error('carPlateNo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <div class="form-group" id="current_make">
                        <label>Available Manufacturer:</label>
                        <input type="text" class="form-control @error('make') is-invalid @enderror" name="make" value="{{$car->make}}"/>
                    </div>
                    @error('make')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <div class="form-group" id="model">
                        <label>Model:</label>
                        <input type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{$car->model}}"/>
                    </div>
                    @error('model')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <div class="form-group">
                        <label>Car year:</label>
                        <input type="text" class="form-control @error('carYear') is-invalid @enderror" name="carYear" value="{{$car->carYear}}" maxlength="4"/>
                    </div>
                    @error('carYear')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <div class="form-group" id="category">
                        <label>Category:</label>
                        {!! Form::select('category',Common::$category,$car->category,[
                            'class' => 'form-control',
                        ]) !!}
                        </div>
                    <div class="form-group">
                        <label>Rate per day</label>
                        <input type="number" class="form-control @error('ratePerDay') is-invalid @enderror" name="ratePerDay" value="{{$car->ratePerDay}}" step="0.01"/>
                    </div>
                    @error('ratePerDay')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror"/>
                    </div>
                    @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <div class="form-group">
                        <label>Description</label>
                        <input type="textarea" rows="10" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$car->description}}" />
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