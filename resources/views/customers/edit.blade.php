<?php 

use App\Common;

?>
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>
                <div class="card-body">
                    <form action="{{ route('customers.update',$customer->id) }}" method="POST" onSubmit="return confirm('Are you sure you wish to update the info?');">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" name="fullName" value="{{ $customer->fullName }}"
                                disabled />
                        </div>
                        <div class="form-group row" id="current_make">
                            <label>IC Number:</label>
                            <input type="text" class="form-control" name="icNumber" value="{{ $customer->icNumber }}"
                                disabled />
                        </div>
                        <div class="form-group row">
                            <label>Driver License Number:</label>
                            <input type="text" class="form-control" name="driverLicenseNumber"
                                value="{{$customer->driverLicenseNumber}}" disabled />
                        </div>
                        <div class="form-group row">
                            <label>Email:</label>
                            <input type="text" class="form-control"  name="email"
                                value="{{$customer->email}}" disabled/>
                        </div>
                        <div class="form-group row">
                            <label>Telephone Number:</label>
                            <input type="text" class="form-control @error('telephoneNo') is-invalid @enderror"
                                name="telephoneNo" value="{{$customer->telephoneNo}}" maxlength="10" />
                            @error('telephoneNo')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label>Address:</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                name="address" value="{{$customer->address}}" maxlength="100" />
                            @error('address')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label>City:</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                value="{{$customer->city}}" />
                            @error('city')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label>State:</label>
                            {!! Form::select('state',Common::$states,$customer->state,[
                            'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group row">
                            <label>Zip Code:</label>
                            <input type="text" class="form-control @error('zipCode') is-invalid @enderror"
                                name="zipCode" value="{{$customer->zipCode}}" maxlength="5" />
                            @error('zipCode')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <input type="submit" class="btn btn-success word" href="{{ route('home') }}" />
                        <a href="{{route('home')}}" class="btn btn-primary word">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection