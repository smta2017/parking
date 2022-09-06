<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerVehicle;
use App\Models\SubscriptionBucket;
use App\Models\ZoneBucket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
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
    public function create(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|numeric|exists:customer_vehicles,id'
        ]);
        $vehicle =  CustomerVehicle::with('Customer')->find($request->vehicle_id);
        $subscriptions = app('rinvex.subscriptions.plan_subscription')->with('plan')->ofSubscriber($vehicle)->get();
        $plans = \Rinvex\Subscriptions\Models\Plan::get();

        $zone_buckets = \DB::select('select zone_buckets.* 
        from zone_buckets 
        left join subscription_buckets on (zone_buckets.id=subscription_buckets.zone_bucket_id)
        left join plan_subscriptions on (plan_subscriptions.id=subscription_buckets.plan_subscription_id)

         where (plan_subscriptions.ends_at is null or plan_subscriptions.ends_at <= CURDATE())
        ;');
        // $zone_buckets = ZoneBucket::rightJoin('subscription_buckets','zone_buckets.id','subscription_buckets.zone_bucket_id')->where('zone_id', session('session_zone_id'))
        //     ->whereHas('SubscriptionBuckets.PlanSubscription', function ($q) {
        //         $q->whereNotIn('id', [1]);
        //     })->orderBy('name')->get();

        // return $subscriptions;
        // return $zone_buckets ;

        return \view('pages.subscription-create', \compact('vehicle', 'subscriptions', 'plans', 'zone_buckets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|numeric',
            'vehicle_id' => 'required|numeric',
            'bucket_id' => 'required|numeric'
        ]);

        $vehicle = CustomerVehicle::find($request["vehicle_id"]);
        $plan = app('rinvex.subscriptions.plan')->find($request["plan_id"]);

        $new_subscription = $vehicle->newSubscription($request["vehicle_id"] . "-" . $plan["price"] . "-" . $request["plan_id"], $plan);

        SubscriptionBucket::create([
            'plan_subscription_id' => $new_subscription->id,
            'zone_bucket_id' => $request->bucket_id
        ]);

        if ($new_subscription) {
            return redirect()->back()->withSuccess('تمت اضافة الاشتراك بنجاح');
        }
        return ['success' => false];
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
