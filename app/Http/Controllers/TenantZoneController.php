<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenantZoneRequest;
use App\Http\Requests\UpdateTenantZoneRequest;
use App\Models\TenantZone;

class TenantZoneController extends Controller
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
     * @param  \App\Http\Requests\StoreTenantZoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTenantZoneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TenantZone  $tenantZone
     * @return \Illuminate\Http\Response
     */
    public function show(TenantZone $tenantZone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TenantZone  $tenantZone
     * @return \Illuminate\Http\Response
     */
    public function edit(TenantZone $tenantZone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTenantZoneRequest  $request
     * @param  \App\Models\TenantZone  $tenantZone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTenantZoneRequest $request, TenantZone $tenantZone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TenantZone  $tenantZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(TenantZone $tenantZone)
    {
        //
    }
}
