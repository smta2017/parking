<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $customers = User::customer()->orderBy('created_at')->get();
        return \view('pages.customer-create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name',
            'phone' => 'required|numeric|unique:users,phone'
        ]);

        $request['is_customer'] = 1;
        if ($user = User::create($request->all())) {
            // return redirect()->back()->withSuccess('تمت الاضافة بنجاح');
            return redirect('/admin/vehicles/create?customer_id=' . $user->id);//->back()->withSuccess('تمت الاضافة بنجاح');

            // return \view('pages.subscription-create');
        }
        // return $request->all();
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $phone
     * @return \Illuminate\Http\Response
     */
    public function showByPhone(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|numeric'
        ]);

        if ($customer = User::customer()->where('phone', $request->phone)->first()) {
            return ['success' => true, 'data' => ['customer' => $customer, 'vehicles' => $customer->CustomerVehicles]];
        }

        return ['success' => false];
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
}
