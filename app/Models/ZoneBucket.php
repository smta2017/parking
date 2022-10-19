<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="ZoneBucket",
 *      required={"zone_id"},
 *      @SWG\Property(
 *          property="zone_id",
 *          description="zone_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
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
class ZoneBucket extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'zone_buckets';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'zone_id',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'zone_id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'zone_id' => 'required'
    ];

    public function SubscriptionBuckets()
    {
        return $this->hasMany(SubscriptionBucket::class);
    }

    public function Zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
