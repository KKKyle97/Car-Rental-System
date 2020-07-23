<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common;
use App\Car;
use App\RentalOrder;
use App\User;
use App\Customer;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Gate;
use DB;
use Session;
use Auth;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = RentalOrder::paginate(10);
        $car = new Car();

        return view('rentals.index',[
            'orders' => $orders,
            'car' => $car,
        ]);
    }

    public function book()
    {
        $orders = RentalOrder::all();
        $car = new Car();

        if(Gate::allows('book')){
            return view('rentals.book',[
                'orders' => $orders,
                'car' => $car,
            ]);
    }

    return view('/home');
    
    }

    public function view()
    {

        $email = User::where('id',Auth::id())->value('email');
        $cust_id = Customer::where('email',$email)->value('id');
        $rental = RentalOrder::orderBy('rentStartDate','desc')->where('customer_id',$cust_id)->paginate(1);

        if(count($rental)==0)
        {
            return redirect()->route('rentals.index')->with('alert','No Booking is Found');
        }

        return view('rentals.view',[
            'rentals' => $rental,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pickup_date = request('pickup_date');
        $return_date = request('return_date');
        $car = Car::find($id);
        $rental = new RentalOrder();

        return view('rentals.create',[
            'car' => $car,
            'pickup_date' => $pickup_date,
            'return_date' => $return_date,
            'rental' => $rental,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = User::where('id',Auth::id())->value('email');
        $cust_id = Customer::where('email',$email)->value('id');
        $rental = new RentalOrder();
        $rental->rentStartDate = $request->rentStartDate;
        $rental->rentEndDate = $request->rentEndDate;
        $rental->rentStartTime= $request->rentStartTime;
        $rental->rentEndTime = $request->rentEndTime;
        $rental->total = $request->total;
        $rental->car_id = $request->car_id;
        $rental->customer_id = $cust_id;
        $rental->save();

        return redirect()->route('home')->with('alert','Booking Successful!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $selected_order = RentalOrder::findOrFail($id);


        return view('rentals.show',[
            'rental' => $selected_order,
        ]);
    }

    public function showall()
    {
        $car = Car::orderBy('make','asc')->paginate(9);
        return view('rentals.gallery',[
            'car' => $car,
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sort($category)
    {
        $pickup_date = request('pickup_date');
        $return_date = request('return_date');
        $sort = request('sorts');
        $car_name = request('car_name');
        $rental = RentalOrder::whereDate('rentEndDate','>=',$pickup_date)->get();
        $cars_id = [];
        foreach($rental as $rentals)
        {
             $cars_id[] = [$rentals->car_id];
        } 

        $unavaliable_lists = [];
        foreach ($cars_id as $cars_id)
        {
            $unavaliable_lists = array_merge($unavaliable_lists,$cars_id);
        }
        
        $price = Str::contains($sort,'price');
        $sorts = substr($sort,6);

        if($price==false)
        {
            $car = Car::orderBy('make',$sorts)
            ->where('category',$category)
            ->where(DB::raw("CONCAT(make, ' ' ,model)"),'like','%'.$car_name.'%')
            ->whereNotIn('id',$unavaliable_lists)
            ->paginate(5);
        }
        else 
        {
            $car = Car::orderBy('ratePerDay',$sorts)
            ->where('category',$category)
            ->where(DB::raw("CONCAT(make, ' ' ,model)"),'like','%'.$car_name.'%')
            ->whereNotIn('id',$unavaliable_lists)
            ->paginate(5);
        }


        return view('rentals.results',[
            'car' => $car->appends(request()->input()),
            'pickup_date' => $pickup_date,
            'return_date' => $return_date,
            'category' => $category,
            'sorts' => $sort,
            'car_name' => $car_name,
        ]);
    }

    public function search()
    {
        $pickup_date = request('pickup_date');
        $return_date = request('return_date');
        $category = request('category');
        $car_name = request('car_name');
        $rental = RentalOrder::whereDate('rentEndDate','>=',$pickup_date)->get();

        $cars_id = [];
        foreach($rental as $rentals)
        {
             $cars_id[] = [$rentals->car_id];
        } 

        $unavailable_lists = [];
        foreach ($cars_id as $cars_id)
        {
            $unavailable_lists = array_merge($unavailable_lists,$cars_id);
        }
        
        $car = Car::orderBy('ratePerDay','asc')
        ->where(DB::raw("CONCAT(make, ' ' ,model)"),'like','%'.$car_name.'%')
        ->where('category',$category)
        ->whereNotIn('id',$unavailable_lists)
        ->paginate(5);
        

        return view('rentals.results',[
            'car' => $car->appends(request()->input()),
            'pickup_date' => $pickup_date,
            'return_date' => $return_date,
            'category' => $category,
            'car_name' => $car_name,
            'sorts' => 'price_asc',
        ]);
    }
}
