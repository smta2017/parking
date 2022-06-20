<?php

namespace App\Repositories;

use App\Models\CustomerVehicle;
use App\Repositories\BaseRepository;

/**
 * Class CustomerVehicleRepository
 * @package App\Repositories
 * @version June 19, 2022, 12:49 am EET
*/

class CustomerVehicleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'customer_id',
        'plate_number',
        'vehicle_color',
        'vehicle_brand',
        'vehicle_model',
        'vehicle_model_year',
        'vehicle_type',
        'license_number',
        'license_expiration'
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

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CustomerVehicle::class;
    }
}
