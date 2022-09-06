<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZoneBucketRequest;
use App\Http\Requests\UpdateZoneBucketRequest;
use App\Models\ZoneBucket;

class ZoneBucketController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZoneBucketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZoneBucketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZoneBucket  $zoneBucket
     * @return \Illuminate\Http\Response
     */
    public function show(ZoneBucket $zoneBucket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ZoneBucket  $zoneBucket
     * @return \Illuminate\Http\Response
     */
    public function edit(ZoneBucket $zoneBucket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZoneBucketRequest  $request
     * @param  \App\Models\ZoneBucket  $zoneBucket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZoneBucketRequest $request, ZoneBucket $zoneBucket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZoneBucket  $zoneBucket
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZoneBucket $zoneBucket)
    {
        //
    }
}
