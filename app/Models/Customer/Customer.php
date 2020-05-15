<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
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
        'updated_at'
    ];
}
