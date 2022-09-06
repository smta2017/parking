<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneBucket extends Model
{
    use HasFactory;

    public function SubscriptionBuckets()
    {
        return $this->hasMany(SubscriptionBucket::class);
    }

    public function Zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
