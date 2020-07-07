<?php

namespace App\Models\Pos;

use App\Models\Pos\Traits\Attribute\PosAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pos extends Model {
    use SoftDeletes, PosAttribute;
	protected $fillable = [
		'id',
		'title',
		'status',
		'created_at',
		'updated_at',
		'deleted_at',
	];
}
