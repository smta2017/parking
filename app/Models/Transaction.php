<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * * @SWG\Definition(
 *      definition="CheckIn",
 *      required={"plate_number"},
 *       @SWG\Property(property="plate_number", type="string", description="car plate number"),
 *       @SWG\Property(property="plate_img", type="string", description="image of car plate"),
 *       @SWG\Property(property="mobile", type="string", description="driver mobile"),
 *       @SWG\Property(property="driver_name", type="string", description="driver name"),
 * ) 

 * @SWG\Definition(
 *      definition="CheckOut",
 *      required={"plate_number"},
 *       @SWG\Property(property="plate_number", type="string", description="car plate number"),
 *       @SWG\Property(property="plate_img", type="string", description="image of car plate"),
 *       @SWG\Property(property="mobile", type="string", description="driver mobile"),
 *       @SWG\Property(property="driver_name", type="string", description="driver name"),
 * ) 
 * @SWG\Definition(
 *      definition="Transaction",
 *      required={"plate_number","plate_img"},
 *      @SWG\Property(
 *          property="plate_number",
 *          description="plate_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="plate_img",
 *          description="plate_img",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="out_at",
 *          description="out_at",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="qr_code",
 *          description="qr_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_payed",
 *          description="is_payed",
 *          type="string"
 *      )
 * )
 *
 */
class Transaction extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    use SoftDeletes;

    use HasFactory;

    public const GENERAL_TRANSACTION = 1;
    public const SUBSCRIBE_TRANSACTION = 2;
    public const OVERNIGHT_TRANSACTION = 3;

    public $table = 'transactions';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'plate_number',
        'plate_img',
        'zone_id',
        'created_by',
        'customer_id',
        'out_at',
        'type',
        'qr_code',
        'is_payed',
        'zone_bucket_id',
        'out_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'plate_number' => 'string',
        'plate_img' => 'string',
        'customer_id' => 'integer',
        'type' => 'integer',
        'zone_id' => 'integer',
        'created_by' => 'integer',
        'out_by' => 'integer',
        'out_at' => 'string',
        'qr_code' => 'string',
        'is_payed' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'plate_number' => 'required',
        'plate_img' => 'required'
    ];

    public static $rules_client = [
        'customer_id' => 'required|exists:users,id,is_customer,1'
    ];



    public function newQuery()
    {
        // session(['session_zone_id' => 1]);
        // session('session_zone_id');

        $df = \session('session_zone_id');
        if (session('session_zone_id')) {
            return parent::newQuery()->where('zone_id', session('session_zone_id'));
        }

        // if (\auth()->check()) {
        //     return parent::newQuery()->where('zone_id', \auth()->user()->zone_id);
        // }

        return  parent::newQuery();
    }

    public function scopeGeneral($query)
    {
        return $query->where('type', self::GENERAL_TRANSACTION);
    }

    public function scopeOvernight($query)
    {
        return $query->where('type', self::OVERNIGHT_TRANSACTION);
    }

    public function scopeSubscribe($query)
    {
        return $query->where('type', self::SUBSCRIBE_TRANSACTION);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function User()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
    }

    public function OutBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'out_by', 'id');
    }

    public function Vehicle()
    {
        return $this->belongsTo(\App\Models\CustomerVehicle::class, 'customer_id', 'id');
    }

    public function Zone()
    {
        return $this->belongsTo(\App\Models\Zone::class, 'zone_id', 'id');
    }
    
    public function bucket(){
        return $this->belongsTo(\App\Models\ZoneBucket::class, 'zone_bucket_id', 'id');

    }
    
}
