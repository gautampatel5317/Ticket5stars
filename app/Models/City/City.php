<?php

namespace App\Models\City;

use App\Models\City\Traits\Attribute\CityAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes, CityAttribute;
    protected $fillable = [
        'id',
        'name',
        'country_id',
        'state_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
    ];
}
