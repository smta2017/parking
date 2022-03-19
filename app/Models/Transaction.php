<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="CheckIn",
 *      required={"plate_number"},
 *       @SWG\Property(property="plate_number", type="string", description="car plate number"),
 *       @SWG\Property(property="plate_img", type="string", description="image of car plate"),
 *       @SWG\Property(property="mobile", type="string", description="driver mobile"),
 *       @SWG\Property(property="driver_name", type="string", description="driver name"),
 * ) 
  
 

  
 * @SWG\Definition(
 *      definition="Transaction",
 *      required={"plate_number"},
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
 *          property="mobile",
 *          description="mobile",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="driver_name",
 *          description="driver_name",
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
 *          property="is_bayed",
 *          description="is_bayed",
 *          type="string"
 *      )
 * )
 */
class Transaction extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'transactions';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'plate_number',
        'plate_img',
        'mobile',
        'driver_name',
        'out_at',
        'qr_code',
        'is_bayed',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'plate_number' => 'string',
        'plate_img' => 'string',
        'mobile' => 'string',
        'driver_name' => 'string',
        'out_at' => 'string',
        'qr_code' => 'string',
        'is_bayed' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'plate_number' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
    }
}
