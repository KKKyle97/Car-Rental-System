<?php

namespace App\Http\Controllers;

use App\Car;
use App\RentalOrder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::orderBy('id','desc')->paginate(9);
        return view('cars.index',[
            'cars' => $cars,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $makes = Car::pluck('make');
        return view('cars.create',[
            'makes' => $makes,
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
        $validated_data = $request->validate([
            'carPlateNo' => 'required|unique:cars|max:7',
            'make' => 'required',
            'model' => 'required',
            'carYear' => 'required|max:4',
            'category' => 'required',
            'ratePerDay' => 'required',
            'image' => 'nullable|image',
            'description' => 'required'
        ]);

        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/Cars',$fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
        $newCar = new Car;

        $newCar->fill($validated_data);
        $newCar->photo = $fileNameToStore;
        $newCar->save();

        return redirect()->route('home')->with('alert','New Car Registered Successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $selected_car = Car::findOrFail($id);

        return view('cars.show',[
            'car' => $selected_car,
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
        $selected_car = Car::findOrFail($id);
        
        return view('cars.edit',[
            'car' => $selected_car,
        ]);
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
        $validated_data = $request->validate([
            'carPlateNo' => 'required|unique:cars,id|max:7',
            'make' => 'required',
            'model' => 'required',
            'carYear' => 'required|max:4',
            'category' => 'required',
            'ratePerDay' => 'required',
            'image' => 'nullable|image',
            'description' => 'required'
        ]);

        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/Cars',$fileNameToStore);
        }
       
        $selected_car = Car::findOrFail($id);
        $selected_car->fill($validated_data);

        if($request->hasFile('image')){
            $selected_car->photo = $fileNameToStore;
        }

        $selected_car->save();

        return $this->show($id)->with('alert','Car Info Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);


        $hasValidRentalRecord = RentalOrder::where('car_id',$car->id)->whereDate('rentEndDate','>',date("Y-m-d"))->count();
        
        if($hasValidRentalRecord!=0){
            echo '<script type="text/javascript">alert("Message´s 1st line\nMessage´s 2nd line");</script>';
            return redirect()->route('cars.index')->with('alert','Sorry! Someone has booked the car! You cannot delete it!');
        }else{
            if($car->photo != 'noimage.jpg'){
                Storage::delete('public/Cars/'.$car->photo);
            }
            $car->delete();
            
            return redirect()->route('cars.index')->with('alert','Car successfully deleted!');
        }

        

    }
}
