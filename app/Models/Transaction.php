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
  
 
/**
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

    public $table = 'transactions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'plate_number',
        'plate_img',
        'zone_id',
        'created_by',
        'out_at',
        'qr_code',
        'is_payed'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'plate_number' => 'string',
        'plate_img' => 'string',
        'zone_id' => 'integer',
        'created_by' => 'integer',
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



    public function newQuery()
    {
        if (session('session_zone_id')) {
            return parent::newQuery()->where('zone_id', session('session_zone_id'));
        }

        if (\auth()->user()->zone_id) {
            return parent::newQuery()->where('zone_id', \auth()->user()->zone_id);
        }
        
        return  parent::newQuery();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function User()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
    }

    public function Zone()
    {
        return $this->belongsTo(\App\Models\Zone::class, 'zone_id', 'id');
    }
}