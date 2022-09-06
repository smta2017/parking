<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentZone extends Model
{
    use HasFactory;

    public function TenantZones()
    {
        return $this->hasMany(TenantZone::class);
    }

    public function Zones()
    {
        return $this->hasMany(Zone::class);
    }

}
