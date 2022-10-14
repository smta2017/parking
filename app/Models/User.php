<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Backpack\CRUD\app\Models\Traits\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles; // <---------------------- and this one
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Rinvex\Subscriptions\Traits\HasSubscriptions;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={"name", "email", "password", "profile_picture"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email_verified_at",
 *          description="email_verified_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="dop",
 *          description="dop",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="profile_picture",
 *          description="profile_picture",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone_verified_at",
 *          description="phone_verified_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="gender",
 *          description="gender",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="sms_notification",
 *          description="sms_notification",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="is_active",
 *          description="is_active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="lang",
 *          description="lang",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="firebase_token",
 *          description="firebase_token",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="google_id",
 *          description="google_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="facebook_id",
 *          description="facebook_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="remember_token",
 *          description="remember_token",
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
class User extends Authenticatable
{
    use SoftDeletes;
    use HasApiTokens, Notifiable;
    use HasFactory;
    use CrudTrait; // <----- this
    use HasRoles; // <------ and this
    // use HasSubscriptions;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'phone2',
        'address',
        'address2',
        'national_id',
        'dob',
        'avatar',
        'phone_verified_at',
        'gender',
        'sms_notification',
        'is_active',
        'is_customer',
        'lang',
        'firebase_token',
        'google_id',
        'facebook_id',
        'zone_id',
        'job_title',
        'edu',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'phone' => 'string',
        'phone2' => 'string',
        'address' => 'string',
        'address2' => 'string',
        'dop' => 'date',
        'avatar' => 'string',
        'phone_verified_at' => 'datetime',
        'gender' => 'string',
        'sms_notification' => 'boolean',
        'is_active' => 'boolean',
        'is_customer' => 'boolean',
        'lang' => 'string',
        'firebase_token' => 'string',
        'google_id' => 'string',
        'facebook_id' => 'string',
        'remember_token' => 'string'
    ];

    public function vehicles($crud = false)
    {
        return '<a class="btn btn-sm btn-link" target="_blank" href="customer-vehicle?customer_id=' . urlencode($this->id) . '" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-car"></i> ' . trans('backpack::crud.model.vehicles') . ' </a>';
    }

    public function scopeCustomer($query)
    {
        return $query->where('is_customer', 1);
    }

    public function scopeSayesZone($query)
    {
        return $query->whereNull('is_customer')->whereZoneId(session('session_zone_id'));
    }
   
    public function Transactions()
    {
        return $this->hasMany(Transaction::class, 'customer_id', 'id');
    }

    public function CustomerVehicles()
    {
        return $this->hasMany(CustomerVehicle::class, 'customer_id', 'id');
    }

    public function subscribe()
    {
        return $this->morphMany('App\Models\PlanSubscription', 'subscriber');
    }

    public function Zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id', 'id');
    }


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        // 'email' => 'email|max:255|unique:users',
        'email_verified_at' => 'nullable',
        // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'password' => 'required|string|max:255',
        'phone' => 'nullable|string|unique:users|max:255',
        'national_id' => 'nullable|string|unique:users|max:255',
        'dob' => 'nullable',
        'phone_verified_at' => 'nullable',
        'gender' => 'nullable|string',
        'sms_notification' => 'nullable|boolean',
        'is_active' => 'nullable|boolean',
        'is_active' => 'nullable|boolean',
        'lang' => 'nullable|string|max:255',
        'firebase_token' => 'nullable|string|max:255',
        'google_id' => 'nullable|string|max:255',
        'facebook_id' => 'nullable|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public static $customer_rules = [
        'name' => 'required|string|max:255',
        // 'email' => 'email|max:255|unique:users',
        'email_verified_at' => 'nullable',
        // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'password' => 'required|string|max:255',
        'phone' => 'required|nullable|string|unique:users|max:255',
        'national_id' => 'nullable|string|unique:users|max:255',
        'dob' => 'nullable',
        'phone_verified_at' => 'nullable',
        'gender' => 'nullable|string',
        'sms_notification' => 'nullable|boolean',
        'is_active' => 'nullable|boolean',
        'is_customer' => 'nullable|boolean',
        'lang' => 'nullable|string|max:255',
        'firebase_token' => 'nullable|string|max:255',
        'google_id' => 'nullable|string|max:255',
        'facebook_id' => 'nullable|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
}
