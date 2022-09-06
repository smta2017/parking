<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Tenant;
use App\Models\TenantZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenantApiController extends Controller
{

    /**
     * @param CreateCustomerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/create-tenant",
     *      summary="Store a newly created tenant in storage",
     *      tags={"Tenant"},
     *      description="Store tenant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Customer that should be stored",
     *          required=false,
     *          @SWG\Schema(example= {
     *                                "name":"customer1",
     *                                "company_name":"company name",
     *                                "email":"test@dsfd.com",
     *                                "address":"customer1",
     *                                "phone":"01236556653",
     *                                "password":"password",
     *                                "zone_id":{1,2,3,4 }
     *                              }
     *          )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */

    public function createTenant(Request $request)
    {

        // $this->validate($request, [
        //     'name'=>'require',
        //     'company_name'=>'require',
        //     'phone'=>'require|numeric',
        //     'email'=>'email',
        //     'address'=>'require',
        // ]);



        $tenant = Tenant::create($request->all());
        $request['tenant_id']= $tenant->id;
        $request['password']= Hash::make($request->password);
        $admin = Admin::create($request->all());
        foreach ($request->zone_id as $value) {
            TenantZone::create([
                'tenant_id' => $tenant->id, 'parent_zone_id' => $value
            ]);
        }
        return $admin ;
        // return Tenant::with('TenantZones')->get();
        // return $tenant->TenantZones;
    }
}
