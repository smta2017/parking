<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'phone',
        'email',
        'address',
    ];
    
    public function Admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function TenantZones()
    {
        return $this->hasMany(TenantZone::class);
    }
}
