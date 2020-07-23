<?php 
use App\Common;
?>

@extends('layouts.app')

@section('content')
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>


.center{
    margin-left:20%;
    margin-top:10%;
    margin-right:20%;
}


.main_menu {
  border-radius: 25px;
  margin-bottom:10px;
  overflow:auto;
}

.menu {
  width: 33%;
  float: left;
  padding-bottom:2%;
  position:relative;
}

.image {
  opacity: 1;
  display: block;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 45%;
  height:100%;
  weight:100%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.text {
  color: black;
  font-size: 25px;
  position: absolute;
  top: 50%;
  left: 45%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

.menu:hover .image {
  opacity: 0.1;
}

.menu:hover .middle {
  opacity: 1;
}

</style>

<div class="justify-content-center" >
  <div class="col-md-8" style=" margin:auto;">
      <div class="card">
        <p class="mx-auto word" style="padding-top:3%;font-size:35px">Car Gallery</p>
          <div class="container word" style="padding:5%;">
            <div class="panel-body" style="overflow:auto;" >
                <div style="width:100%;height:20%" >
                  <div class ="main_menu">
                    @foreach($car as $cars)
                    @if(Storage::disk('public')->exists('Cars/'.$cars->photo))
                    <div class="menu">
                    <img src ="/storage/Cars/{{$cars->photo}}" class="image" width="270" height="170"  style="margin:10px;border-radius:25px;">
                        <div class="middle">
                        <b class="mx-auto" style="font-size:18px">{{Common::$category[$cars->category]}}</b>
                        </div>
                        
                        <div class="middle">
                            <div class="text"><b>{{$cars->make}} {{$cars->model}}</b></div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    
                  </div>
                  <div class="cancel-btn">
                  {{$car->links()}}
                  </div>
           

          </div>
      </div>
  </div>
</div>


<script>


</script>

@endsection