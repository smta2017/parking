<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Backpack\CRUD\app\Models\Traits\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'dob',
        'avatar',
        'phone_verified_at',
        'gender',
        'sms_notification',
        'is_active',
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
        'dop' => 'date',
        'avatar' => 'string',
        'phone_verified_at' => 'datetime',
        'gender' => 'string',
        'sms_notification' => 'boolean',
        'is_active' => 'boolean',
        'lang' => 'string',
        'firebase_token' => 'string',
        'google_id' => 'string',
        'facebook_id' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'email_verified_at' => 'nullable',
        // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'password' => 'required|string|max:255',
        'phone' => 'nullable|string|unique:users|max:255',
        'dob' => 'nullable',
        'phone_verified_at' => 'nullable',
        'gender' => 'nullable|string',
        'sms_notification' => 'nullable|boolean',
        'is_active' => 'nullable|boolean',
        'lang' => 'nullable|string|max:255',
        'firebase_token' => 'nullable|string|max:255',
        'google_id' => 'nullable|string|max:255',
        'facebook_id' => 'nullable|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
