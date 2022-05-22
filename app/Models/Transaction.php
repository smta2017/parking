<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="Transaction",
 *      required={"plate_number", "plate_img"},
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
 *          property="zone_id",
 *          description="zone_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_by",
 *          description="created_by",
 *          type="integer",
 *          format="int32"
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
 *          type="boolean"
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
        'is_bayed'
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
        'is_bayed' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'plate_number' => 'required',
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