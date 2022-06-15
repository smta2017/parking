<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class CustomerRepository
 * @package App\Repositories
 * @version June 14, 2022, 10:50 pm EET
 */

class CustomerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'national_id',
        'dop',
        'profile_picture',
        'phone_verified_at',
        'gender',
        'sms_notification',
        'is_active',
        'lang',
        'firebase_token',
        'google_id',
        'facebook_id',
        'remember_token',
        'is_customer'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }
    
    public function getCustomerByPhone($phone)
    {
      return User::where('phone', $phone)->customer()->first();
    }
    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
