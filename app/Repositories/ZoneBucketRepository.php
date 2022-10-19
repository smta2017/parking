<?php

namespace App\Repositories;

use App\Models\ZoneBucket;
use App\Repositories\BaseRepository;

/**
 * Class ZoneBucketRepository
 * @package App\Repositories
 * @version October 19, 2022, 11:06 pm EET
*/

class ZoneBucketRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'zone_id',
        'name'
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
        return ZoneBucket::class;
    }
}
