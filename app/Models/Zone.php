<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Zone",
 *      required={"name"},
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="manager",
 *          description="manager",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
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
class Zone extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'zones';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'address',
        'is_closed',
        'manager',
        'capacity',
        'hour_rate',
        'phone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'address' => 'string',
        'is_closed' => 'integer',
        'manager' => 'string',
        'capacity' => 'integer',
        'hour_rate' => 'float',
        'phone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public  function scopeZoneCapacity($query)
    {
        return $query->find(session('session_zone_id'))->capacity;
    }

    public  function scopeHourRate($query)
    {
        return $query->find(session('session_zone_id'))->hour_rate;
    }

    public  function scopeSecondHourRate($query)
    {
        return $query->find(session('session_zone_id'))->second_hour_rate;
    }

}
