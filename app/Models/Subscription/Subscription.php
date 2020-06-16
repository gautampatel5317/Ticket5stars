<?php

namespace App\Models\Subscription;

use App\Models\Subscription\Traits\Attribute\SubscriptionAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes, SubscriptionAttribute;
    public $table = 'subscription_type';
    protected $fillable = [
        'id',
        'name',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
