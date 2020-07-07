<?php

namespace App\Http\Requests\Backend\Pos;

use App\Pos;
use Illuminate\Foundation\Http\FormRequest;

class StorePosRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('pos_create');
	}

	public function rules() {
		return [
			'title' => 'required',
		];
	}
}
