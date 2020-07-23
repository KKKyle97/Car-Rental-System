@extends('layouts.app')

@section('content')
<div class="container word">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hi {{ Auth::user()->name}}! Welcome to car renting system! 
                </div>
                
            </div>
            @if(Auth::user()->roles == "admin")
            <div class="card card-margin">
                <div class="card-header">Car Management</div>

                <div class="card-body ">
                    <a href=" {{route('cars.create')}} "><button class="btn btn-success word">Register New Car</button></a>
                    <a href=" {{route('cars.index')}} "><button class="btn btn-warning word">Manage Car</button></a>
                </div>
            </div>
            @endif

            @if(Auth::user()->roles == "admin")
            <div class="card card-margin">
                <div class="card-header">Customer Management</div>

                <div class="card-body">
                    <a href="{{route('customers.index')}}"><button class="btn btn-secondary word">View Customer Profile</button></a> 
                </div>
            </div>

            <div class="card card-margin">
                <div class="card-header">Rent Order Management</div>

                <div class="card-body">
                    <a href="{{route('rentals.index')}}"><button class="btn btn-secondary word">View Rent Order</button></a>
                </div>
            </div>
            @else
            <div class="card card-margin">
                <div class="card-header">Profile Management</div>

                <div class="card-body">
                    <a href="{{route('customers.show',Auth::user()->email)}}"><button class="btn btn-secondary word">View Profile</button></a>
                    <a href="{{route('customers.edit',Auth::user()->email)}}"><button class="btn btn-secondary word">Edit Profile</button></a>
                </div>
            </div>

            <div class="card card-margin">
                <div class="card-header">Rent Order Management</div>

                <div class="card-body">
                    <a href="{{route('rentals.view',Auth::user()->email)}}"><button class="btn btn-secondary word">View Rent Order</button></a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

<script>
   var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
    alert(msg);
    }</script>
