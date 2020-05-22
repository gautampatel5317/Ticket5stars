<?php

namespace App\Models\Customer;

use App\Models\Customer\Traits\Attribute\CustomerAttribute;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use SoftDeletes, Notifiable, ModelTrait, CustomerAttribute;
    protected $fillable = [
        'id',
        'first_name',
        'family_name',
        'email',
        'experience',
        'business',
        'confirmed',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by'
    ];
}
