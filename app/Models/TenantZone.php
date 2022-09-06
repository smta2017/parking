<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'parent_zone_id'
    ];

    public function Tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function ParentZone()
    {
        return $this->belongsTo(ParentZone::class,'parent_zone_id','id');
    }
}
