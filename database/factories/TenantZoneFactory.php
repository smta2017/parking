<?php

namespace Database\Factories;

use App\Models\ParentZone;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantZoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenant_id' =>Tenant::pluck('id')->random(),
            'parent_zone_id' =>ParentZone::pluck('id')->random(),
        ];
    }
}
