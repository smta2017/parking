<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rinvex\Subscriptions\Models\PlanSubscription;

class SubscriptionBucket extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_subscription_id',
        'zone_bucket_id'
    ];

    public function PlanSubscription()
    {
        return $this->belongsTo(PlanSubscription::class);
    }

    public function ZoneBucket()
    {
        return $this->belongsTo(ZoneBucket::class);
    }
}
