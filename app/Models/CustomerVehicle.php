<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rinvex\Subscriptions\Traits\HasSubscriptions;

/**
 * @SWG\Definition(
 *      definition="CustomerVehicle",
 *      required={"customer_id"},
 *      @SWG\Property(
 *          property="plate_number",
 *          description="plate_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="vehicle_color",
 *          description="vehicle_color",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="vehicle_brand",
 *          description="vehicle_brand",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="vehicle_model",
 *          description="vehicle_model",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="vehicle_model_year",
 *          description="vehicle_model_year",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="license_number",
 *          description="license_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="license_expiration",
 *          description="license_expiration",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class CustomerVehicle extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use SoftDeletes;

    use HasFactory;

    use HasSubscriptions;

    public $table = 'customer_vehicles';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'customer_id',
        'plate_number',
        'vehicle_color',
        'plate_image',
        'vehicle_brand',
        'vehicle_model',
        'vehicle_model_year',
        'vehicle_type',
        'license_number',
        'license_expiration'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'plate_number' => 'string',
        'vehicle_color' => 'string',
        'plate_image' => 'string',
        'vehicle_brand' => 'string',
        'vehicle_model' => 'string',
        'vehicle_model_year' => 'string',
        'license_number' => 'string',
        'license_expiration' => 'date'
    ];

    public function printQr($crud = false)
    {
        return '<a target="_blank" class="btn btn-sm btn-link" href="/client-qr/' . urlencode($this->id) . '" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-qrcode"></i> ' . trans('backpack::crud.model.printqr') . ' </a>';
    }

    public function subscribe($crud = false)
    {
        return '';//'<a target="_blank" class="btn btn-sm btn-link" href="/client-qr/' . urlencode($this->id) . '" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-link"></i> ' . trans('backpack::crud.model.subscribe') . ' </a>';
    }

    public function scopeCustomerVehicle($query)
    {
        $customer_id= \request('customer_id');
        if ($customer_id) {
            return $query->where('customer_id', \request('customer_id'));
        }
    }

    public function Customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'customer_id', 'id');
    }

    public function PlanSubscriptions()
    {
        return $this->hasMany(PlanSubscription::class);
    }


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'customer_id' => 'required'
    ];
}
