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
  width: 25%;
  float: left;
  padding:3%;

}

.menu-price {
  width: 30%;
  float: right;
  padding: 3%;
}

.menu-pricing {
    padding-right: 30%;
    font-size: 1.4vw;
    text-align: end;
  }

.main {
  width: 40%;
  float: left;
  padding-left: 3%;

}



</style>

<body onload ="setIndex()">

<div class="justify-content-center" >
  <div class="col-md-8" style=" margin:auto;">
      <div class="card">
          <div class="container word" style="padding:5%;">
            <div class="panel-body" style="overflow:auto;" >
              <div class="col-sm-4" style="float:left;">
                <label>Category:</label>
                @foreach(Common::$category as $key=>$value)
                  <div class="form-group row">
                    <div class="col-sm-7">
                    <input type="radio" name="Category" value="{{$key}}" onclick="document.location.href='{!! route("rentals.sort",array('category'=>$key,'car_name'=>$car_name,'pickup_date' =>$pickup_date,'return_date'=>$return_date,'sorts'=>$sorts)) !!}'">{{$value}}
                    </div>
                  </div>
                @endforeach
              </div>

              <div class="col-sm-6 " style="float:right;">
                <form method="get" action="{{route('rentals.search')}}">
                  <div class="form-group row">
                    {!! Form::label('car-name','Car Name',['class' => 'control-label col-sm-3']) !!}
                      <div class="col-sm-7">
                        {!! Form::text('car_name', $car_name,[
                        'class' => 'form-control',
                        'placeholder' =>'Enter Car Name (Optional)'])!!}
                      </div>
                  </div>

                  <div class="form-group row" >
                    {!! Form::label('start-date','Pickup Date',['class' => 'control-label col-sm-3']) !!}
                      <div class="col-sm-7">
                        {!! Form::date('pickup_date', $pickup_date,[
                        'class' => 'form-control',
                        'id' => 'from',
                        'onchange' => 'validateDate()'])!!}
                      </div>
                  </div>

                  <div class="form-group row">
                    {!! Form::label('return date','Return Date',['class' => 'control-label col-sm-3']) !!}
                      <div class="col-sm-7">
                        {!! Form::date('return_date', $return_date,[
                        'class' => 'form-control',
                        'id' => 'to',
                        'onchange' => 'validateDate()'])!!}
                      </div>
                  </div>

                <!-- Hidden Input to Pass into parameter -->
                <input type="text" name="category" value="{!! $category !!}" hidden></input>
                <input type="text" name="sorts" value="{!! $sorts !!}" hidden></input>

                  {!! Form::button('Search',[
                  'type' => 'submit',
                  'class' => 'btn btn-primary word']) !!}

                </form>
              </div>
            </div>



            @if (count($car) > 0)
            <div class="container">
              <div class="form-group row">
                <div class="col-sm-4" >
                  <select class="form-control" id="car_sorting" onchange="car_Sorting()">
                    <option value= "price_asc">Sort By Price: Low To High</option>
                    <option value= "price_desc">Sort By Price: High To Low</option>
                    <option value= "model_asc">Sort By Model: A-Z</option>
                    <option value= "model_desc">Sort By Model: Z-A</option>
                  </select>
                </div>
              </div>
              @foreach($car as $cars)
                <div style="width:100%;height:20%" >
                  <div class ="main_menu">
                    <div class="menu ">
                      @if(Storage::disk('public')->exists('Cars/'.$cars->photo))
                        <img src ="/storage/Cars/{{$cars->photo}}" width="150" height="100"  style="margin:10px;" >
                      @endif
                    </div>
                    
                    <div class = "main">
                      <h3>{{$cars->make}} {{$cars->model}}</h3>
                      <p>{{Common::$category[$cars->category]}} Category</p>
                      <p>Year {{$cars->carYear}}</p>
                      <p>{{$cars->description}}</p>         
                    </div>

                    <div class = "menu-price">
                        <div style="padding-left:30%;padding-right:30%;padding-top:10%">
                          <a href='{!! route("rentals.create",array('id'=>$cars->id,'pickup_date' =>$pickup_date,'return_date'=>$return_date)) !!}'>
                          <button class='btn btn-warning word'>Select</button></a>
                          <h5>RM{{$cars->ratePerDay}}</h5>
                      </div>
                    </div>
                  </div>
              </div>
              @endforeach
              <div class="cancel-btn">
              <span>{{$car->links()}}</span>
              </div>
              
            </div>
            @else
            <script>alert('No Car is Found')</script>
            @endif

          </div>
      </div>
  </div>
</div>
</body>


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

  function car_Sorting()
  {
    var e = document.getElementById("car_sorting");
    var value = e.options[e.selectedIndex].value;
    if (value=="price_asc")
    {
      document.location.href="{!! route("rentals.sort",array('category'=>$category,'car_name'=>$car_name,'pickup_date' =>$pickup_date,'return_date'=>$return_date,'sorts'=>'price_asc')) !!}";
    }
    else if(value=="price_desc")
    {
      document.location.href="{!! route("rentals.sort",array('category'=>$category,'car_name'=>$car_name,'pickup_date'=>$pickup_date,'return_date'=>$return_date,'sorts'=>'price_desc')) !!}";
    }
    else if(value=="model_asc")
    {
      document.location.href="{!! route("rentals.sort",array('category'=>$category,'car_name'=>$car_name,'pickup_date'=>$pickup_date,'return_date'=>$return_date,'sorts'=>'model_asc')) !!}";
    }
    else if(value=="model_desc")
    {
      document.location.href="{!! route("rentals.sort",array('category'=>$category,'car_name'=>$car_name,'pickup_date'=>$pickup_date,'return_date'=>$return_date,'sorts'=>'model_desc')) !!}";
    }
  }

  function setIndex()
  {
    var index = 0 ;
    var sorts = "<?php echo $sorts ?>";

    var category = document.getElementsByName('Category'); 
    for(i = 0; i < category.length; i++)
    { 
      if(category[i].value== <?php echo $category?> ) 
      {
        category[i].checked = true;
      }
    } 

    if (sorts == "price_desc")
    {
        index = 1;
    }
    else if(sorts == "model_asc")
    {
      index =2;
    }
    else if(sorts == "model_desc")
    {
      index = 3;
    }
    document.getElementById('car_sorting').selectedIndex = index;

    
  }

</script>

@endsection