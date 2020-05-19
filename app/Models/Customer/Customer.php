<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
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
        'deleted_at'
    ];
}
