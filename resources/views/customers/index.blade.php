<?php 

use App\Common;

?>@extends('layouts.app')

@section('content')

<table class="table table-borderless table-hover customer_table table-light word">
  <thead> 
    <tr>
      <th>Customer Id</th>
      <th>Full Name</th>
      <th>IC Number</th>
      <th>Tel No</th>
      <th>Email</th>
      <th>License No</th>
      <th></th>
    </tr>
  </thead>
  @foreach($customers as $customer)
  <tr>
    <td>{{$customer->id}}</td>
    <td>{{$customer->fullName}}</td>
    <td>{{$customer->icNumber}}</td>
    <td>{{$customer->telephoneNo}}</td>
    <td>{{$customer->email}}</td>
    <td>{{$customer->driverLicenseNumber}}</td>
    <td><a href="{{route('customers.show',$customer->id)}}" class="btn btn-secondary">View More</a></td>
  </tr>
  @endforeach
  <tr>
    <td colspan="7">{{ $customers->links() }}</td>
  </tr>
</table>

<div class="cancel-btn">
    <a href="{{route('home')}}"  class="btn btn-primary word" style="margin:auto; width:fit-content;">Back</a>
</div>


@endsection