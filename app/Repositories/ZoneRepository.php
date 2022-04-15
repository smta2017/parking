<?php

namespace App\Repositories;

use App\Models\Zone;
use App\Repositories\BaseRepository;

/**
 * Class ZoneRepository
 * @package App\Repositories
 * @version April 5, 2022, 8:50 pm UTC
*/

class ZoneRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'manager',
        'capacity',
        'phone'
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
        return Zone::class;
    }
}
