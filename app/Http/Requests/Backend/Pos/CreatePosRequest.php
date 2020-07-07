<?php

namespace App\Http\Requests\Backend\Pos;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class CreatePosRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('pos_create');
	}

	public function rules() {
		return [
		];
	}
}
