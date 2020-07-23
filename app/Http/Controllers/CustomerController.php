<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(10);

        return view('customers.index',[
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->roles=="admin"){
            $selected_customer = Customer::findOrFail($id);
            $records_of_selected_customer = $selected_customer->rentalOrders;
        }elseif(Auth::user()->roles=="customer"){
            $selected_customer = Customer::where('email',$id)->first();
            $records_of_selected_customer = $selected_customer->rentalOrders;
        }
       

        return view('customers.show',[
            'customer' => $selected_customer,
            'records' => $records_of_selected_customer,
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
        $selected_customer = Customer::where('email',$id)->first();
        //$this->authorize('update', $selected_customer );

        return view('customers.edit',[
            'customer' => $selected_customer,
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
        $request->validate([
            'telephoneNo' => ['required', 'digits:10'],
            'address' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'zipCode' => ['required', 'digits:5'],
        ]);

        $customer = Customer::findOrFail($id);
        $this->authorize('update', $customer);

        //Prevent filling of static particular
        $customer->fill(
            [
                'telephoneNo' => $request->telephoneNo,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zipCode' => $request->zipCode,
            ]
        );
        
        $customer->save();

        return redirect()->route('home')->with('alert','Profile Updated Successful!');
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
}
